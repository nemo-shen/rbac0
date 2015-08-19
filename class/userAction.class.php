<?php 
require_once 'mysql.class.php';
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . 'rbac/config.php';

class userAction extends common{
    
    /**
     * 用户登陆
     * @param string $username
     * @param string $password
     * @throws Exception
     */
    public function login ($username, $password) {
        try {
            if (empty($username)) throw new Exception('请填写用户名');
            if (empty($password)) throw new Exception('请填写密码');
            $username = addslashes($username);
            $password = md5(addslashes($password));
            $mysql = C('mysql');
            if (!$result = $mysql->fetchOne('id', 'user', "name='{$username}' and pass='{$password}'")) {
                throw new Exception('登陆失败');
            }
            $_SESSION['uid'] = $result['id'];
            $_SESSION['username'] = $username;
            parent::__construct();
            $this->check_permission(__FUNCTION__);
            jump('登陆成功','admin.php', true);
        } catch (Exception $e) {
            echo $e->getMessage();
            jump('','login.html');
        }
    }
    
    /**
     * 用户退出
     */
    public function logout () {
        session_destroy();
        jump('','login.html','',0);
    }
    
    /**
     * 添加用户
     * @param string $username
     * @param string $password
     * @throws Exception
     */
    public function addUser ($data) {
        $this->check_permission(__FUNCTION__);
        try {
            if (empty($data)) {
                jump('', 'pages/addUser.php','',0);
            } else {
                $new_key = array('name','pass');
                $old_key = array('username','password');
                $data = keysConventer($data, $old_key, $new_key);
                $data['pass'] = md5($data['pass']);
            }
            if(empty($data['name'])) throw new Exception('用户名不能为空');
            if(empty($data['pass'])) throw new Exception('密码不能为空');
            $mysql = C('mysql');
            if ($result = $mysql->insert('user', $data)) {
                $ua = array(
                    'uid' => $result,
                    'rid' => NORMAL_ROLE_ID
                );
                if (($mysql->insert('user_assignment', $ua)) !== false){
                   jump('用户添加成功', 'pages/userList.php', true);
                } else {
                    $mysql->delete('user', "id={$result}");
                    throw new Exception('用户添加失败');
                }
            } else {
                throw new Exception('用户添加失败');
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/userList.php');
        }
    }
    
    /**
     * 编辑用户
     * @param int $id
     * @param array $data
     * @throws Exception
     */
    public function editUser ($id, $data) {
        $this->check_permission(__FUNCTION__);
        try {
            if (empty($id) || !is_numeric($id)) throw new Exception('修改用户失败');
            $data['id'] = $id;
            if (empty($data['name'])) throw new Exception('修改用户失败');
            $data['name'] = addslashesed($data['name']);
            if (!array_key_exists('password', $data)) throw new Exception('修改用户失败');
            $data['pass'] = $data['password'];
            unset($data['password']); 
            $mysql = C('mysql');
            if (is_numeric($data['rid']) && (int)$data['rid'] !== 0) {
                $ua_data = array(
                    'uid' => $data['id'],
                    'rid' => $data['rid']
                );
                if ($mysql->fetchOne('uid,rid' ,'user_assignment', "uid={$ua_data['uid']} AND rid={$ua_data['rid']}")) throw new Exception('用户已有该角色，请勿重复添加');
                if ($mysql->insert('user_assignment', $ua_data) === false) throw new Exception('添加角色失败');
            } 
            unset($data['rid']);
            unset($data['id']);
            if ($mysql->update('user', $data, "id={$id}")) {
                jump('用户修改成功', 'pages/userList.php', true);
            } else {
                throw new Exception('修改用户失败');
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/userList.php');
        }
    }
    
    public function delUser ($id) {
        $this->check_permission(__FUNCTION__);
        try {
            if (!is_numeric($id) || empty($id)) throw new Exception('用户删除失败');
            $mysql = C('mysql');
            $where = "id={$id}";
            $where_ua = "uid = {$id}";
            if ($mysql->delete('user', $where) && $mysql->delete('user_assignment', $where_ua)) {
                jump('删除成功', 'pages/userList.php', true);
            } else {
                jump('删除失败', 'pages/userList.php');
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/userList.php');
        }
    }
    
    /**
     * 显示指定用户
     * @param int $id
     */
    public function showUser ($id) {
        $this->check_permission(__FUNCTION__);
        $mysql = C('mysql');
        $result = $mysql->fetchOne('id,name,pass', 'user', "id={$id}");
        $ua_result = $mysql->fetchAll('rid', 'user_assignment', "uid={$id}");
        $cursor = 0;
        if ($ua_result == false) return $result;
        foreach ($ua_result as $value) {
            $role_result = $mysql->fetchAll('id,name', 'role', "id={$value['rid']}");
            
            foreach ($role_result as $key => $value) {
                $role_results[] = $value;
            }
        }
        $result['role'] = $role_results;
        return $result;
    }
    
    /**
     * 用户列表
     * @param bool $is_show
     */
    public function userList ($is_show = false) {
        $this->check_permission(__FUNCTION__);
        if ($is_show == false) {
            jump('', 'pages/userList.php','',0);
        } else {
            $mysql = C('mysql');
            $parent_rid[] = $mysql->fetchAll('rid', 'user_assignment', "uid={$_SESSION['uid']}");
            $parent_rids = multiToOneArray($parent_rid);
            foreach ($parent_rids as $value) {
                $res[] = $this->usersOfRole($value['rid']);
            }
            $result = multiToOneArray($res);
            $result = $this->arrayUnqie($result);
            return $result;
        }
    }
    
    /**
     * 寻找指定角色下的所有用户
     * @param number $pid
     * @return array
     */
    public function usersOfRole ($pid) {
        $mysql = C('mysql');
            $result = $this->recursionUser($pid);
            // 找到跟此父角色有关所有子角色，并添加到$results
            foreach ($result as $value) {
                if (($res = $mysql->fetchAll('uid,rid', 'user_assignment', "rid={$value['id']}")) != false){
                    $results[] = $res;
                }
            }
            $res_ua = multiToOneArray($results);
            $max_offset = count($res_ua);
            for ($offset = 0; $offset < $max_offset; $offset++) {
                for ($offset_in = 0; $offset_in < $max_offset; $offset_in++) {
                    if ($offset < $offset_in){
                        if ($res_ua[$offset]['uid'] == $res_ua[$offset_in]['uid']){
                            $res_ua[$offset] = array('uid' => '','rid'=>'');
                        }
                    }
                }
            }
            $my_rid = $mysql->fetchAll('rid,uid','user_assignment', "uid={$_SESSION['uid']}");
            foreach ($my_rid as $value) {
                $my_rids[] = $value['rid'];
                $my_rids[] = $value['uid'];
            }
            $result_user = array();
            foreach ($res_ua as $value) {
                if (!empty($value['uid'])){
                       $user = $mysql->fetchOne('id,name', 'user', "id={$value['uid']}");
                       $ua_user = $mysql->fetchAll('rid,uid', 'user_assignment', "uid={$user['id']}");
                       $user_rids = array();
                       foreach ($ua_user as $val) {
                           $user_rids[] = $val['rid'];
                           $user_rids[] = $val['uid'];
                       }
                       if (!empty(array_diff($my_rids, $user_rids))) {//如果不为空，那么这个用户的角色要么是操作用户的子集，要么两者拥有的角色互不相干
                           if (empty(array_diff($user_rids, $my_rids))){//如果为空，这个用户的角色是操作用户所拥有角色的子集
                               $result_user[] = $mysql->fetchOne('id,name', 'user', "id={$value['uid']}");
                           } else{//反之，如果不为空，那么两者的角色互不相干
                                if (count($user_rids) === 2){
                                    $result_user[] = $mysql->fetchOne('id,name', 'user', "id={$value['uid']}");
                                } elseif($my_rids[1] == (int)1){
                                    $result_user[] = $mysql->fetchOne('id,name', 'user', "id={$value['uid']}");
                                }
                           }
                       } else {//反之，如果为空，则操作用户可能是该用户的子集，或者两者权限相当
                           if (empty(array_diff($user_rids, $my_rids))){//如果还是为空，则对比的是自身。这里设定如果对比的两个用户角色相当则无法相互显示，
                      //对比的是自身问题没有解决！！！！！！！                                                  //当然也可以改成可以互相显示，只需要删除$my_rids和$user_rids遍历中的uid
                               $result_user[] = $mysql->fetchOne('id,name', 'user', "id={$value['uid']}");
                           } else {// 反之，操作用户是该用户的子集
                               
                           }
                       }
                }
            }
            return $result_user;
    }
    
    /**
     * 递归查询出父角色以及其所有子角色，并以数组形式返回
     * @param number $pid
     * @param array $results
     * @param array $result
     * @return array
     */
    public function recursionUser (&$pid, &$results=array(), $result=array()) {
        $mysql = C('mysql');
        if (empty($results)){
            $results[] = $mysql->fetchOne('id,pid,name', 'role', "id={$pid}");
        }
        if (($result = $mysql->fetchAll('id,pid,name', 'role', "pid={$pid}")) == false) return $results;
        $results = array_merge_recursive($results, $result);
        foreach ($result as $value) {
            self::recursionUser($value['id'], $results);
        }
        return $results;
    }
}
?>

