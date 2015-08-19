<?php 
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . 'rbac/config.php';

class role extends common{
    
    /**
     * 添加角色
     * @param string $data
     * @throws Exception
     */
    public function addRole($data='') {
        $this->check_permission(__FUNCTION__);
        try {
            if (empty($data)){
                jump('' ,'pages/addRole.php','',0);
            } else {
                if (empty($data)) throw new Exception('没有角色名');
                $data['name'] = addslashesed($data['name']);
                $mysql = C('mysql');
                $data['pid'] = $_SESSION['uid'];
                if ($mysql->insert('role', $data)) {
                    jump('角色添加成功', 'pages/roleList.php', true);
                } else {
                    throw new Exception('角色添加失败');
                }
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'roleList.php');
        }
    }
    
    /**
     * 显示角色列表
     * @param string $field
     */
    public function roleList ($is_show = false) {
        $this->check_permission(__FUNCTION__);
        if ($is_show === false) {
            jump('','pages/roleList.php','',0);
        } else {
            $mysql = C('mysql');
            $ua_rid = $mysql->fetchAll('rid', 'user_assignment', "uid={$_SESSION['uid']}");
            foreach ($ua_rid as $value) {
                $roleList[] = $this->recursionRole($value['rid']);
            }
            $roleList = $this->arrayUnqie(multiToOneArray($roleList));
            return $roleList;
        }
    }
    
    /**
     * 递归查询出父角色以及其所有子角色，并以数组形式返回
     * @param number $pid
     * @param array $results
     * @param array $result
     * @return array
     */
    public function recursionRole (&$pid, &$results=array(), $result=array()) {
        $mysql = C('mysql');
        if (empty($results)){
            $results[] = $mysql->fetchOne('id,pid,name', 'role', "id={$pid}");
        }
        if (($result = $mysql->fetchAll('id,pid,name', 'role', "pid={$pid}")) == false) return $results;
        $results = array_merge_recursive($results, $result);
        foreach ($result as $value) {
            self::recursionRole($value['id'], $results);
        }
        return $results;
    }
    
    /**
     * 查询出指定角色下的所有权限
     * @param number $pid
     * @return boolean|array
     */
    public function paList ($pid) {
        $mysql = C('mysql');
        if (!$result = $mysql->fetchAll('*', 'permission_assignment', "rid={$pid}")) return false;
        foreach ($result as $value) {
            $res = $mysql->fetchAll('id,pid,name', 'permission', "id={$value['pid']}");
            foreach ($res as $value) {
                $results[] = $value;
            }
        }
        return $results;
    }
    
    /**
     * 编辑角色
     * @param int $id
     * @param string $name
     * @throws Exception
     */
    public function editRole ($id, $data) {
        $this->check_permission(__FUNCTION__);
        $mysql = C('mysql');
        try {
            if (!empty($id) && is_numeric($id)){
                if (!empty($data['pid']) && is_numeric($data['pid'])) {
                    if (!($pid = $mysql->fetchOne('id', 'permission', "id={$data['pid']}"))) throw new Exception('没有这样的权限');
                    $pa_data = array(
                        'rid' => $id,
                        'pid' => $pid['id']
                    );
                    if (!$mysql->fetchOne('rid,pid', 'permission_assignment', "rid={$pa_data['rid']} AND pid={$pa_data['pid']}")){
                        if (($mysql->insert('permission_assignment', $pa_data)) === false) throw new Exception('赋予角色权限失败');
                    } else {
                        throw new Exception('该角色已有此权限，请勿重复添加');    
                    }
                } elseif (!empty($data) && is_numeric($data)) {
                    $result = $mysql->fetchAll('rid,pid', 'permission_assignment', "rid={$id}");
                foreach ($result as $value) {
                        $permissionAll[] = $mysql->fetchAll('id,pid', 'permission', "id={$value['pid']}");
                    }
                    foreach ($permissionAll as $value) {
                        foreach ($value as $val) {
                            $permissionAlls[] = $val;
                        }
                    }
                    $results = AllAssocPermission($permissionAlls, $data, $data);
                    foreach ($results as $value) {
                        if (!$mysql->delete('permission_assignment', "rid={$id} AND pid={$value['id']}")){
                            jump('权限删除失败',"index.php?action=editRole&id={$id}");
                        }
                    }
                   jump('权限删除成功',"index.php?action=editRole&id={$id}", true);
                   return true;
                }
                if (isset($data['pid'])) unset($data['pid']);
                $where = "id={$id}";
                if ($mysql->update('role', $data, $where)){
                    jump('角色修改成功', 'pages/roleList.php', true);
                } else {
                    throw new Exception('角色修改失败');
                }
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/roleList.php');
        }
    }
    
    /**
     * 显示指定角色
     * @param int $id
     */
    public function showRole ($id) {
        $this->check_permission(__FUNCTION__);
        $mysql = C('mysql');
        return $result = $mysql->fetchOne('id,name', 'role', "id={$id}");
    }
    
    /**
     * 删除角色
     * @param number $id
     * @throws Exception
     */
    public function delRole ($id) {
        $this->check_permission(__FUNCTION__);
        try {
            if (!is_numeric($id) || empty($id)) throw new Exception('角色删除失败');
            $mysql = C('mysql');
            $where = "id={$id}";
            $where_ua = "rid={$id}";
            if ($mysql->delete('user_assignment', $where_ua)) {
                if ($mysql->delete('role', $where)) {
                    jump('删除成功', 'pages/roleList.php', true);
                } else {
                    throw new Exception('删除失败');
                }
            } else {
                throw new Exception('删除失败');
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/roleList.php');
        }
    }
    
}

?>