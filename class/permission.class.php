<?php 
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . 'rbac/config.php';

class permission extends common{
    
    /**
     * 添加权限
     * @param int $pid
     * @param string $name
     * @throws Exception
     */
    public function addPermission($data) {
        $this->check_permission(__FUNCTION__);
        try {
            if (empty($data)){
                jump('' ,'pages/addPermission.php','',0);
            } else {
                if (!is_numeric($data['pid'])) throw new Exception('添加权限失败');
                if (empty($data['pid']) && (int)$data['pid'] !== 0) throw new Exception('添加权限失败');
                if (empty($data['name'])) throw new Exception('添加权限失败');
                $data['name'] = addslashesed($data['name']);
                $data['fname'] = !empty($data['fname']) ? addslashesed($data['fname']) : '';
                $mysql = C('mysql');
                if ($mysql->insert('permission', $data)) {
                    jump('权限添加成功', 'pages/permissionList.php', true);
                } else {
                    throw new Exception('权限添加失败');
                }
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/permissionList.php');
        }
    }
    
    /**
     * 显示权限表中所有数据
     * @param string $field
     */
    public function permissionList ($is_show = false) {
        $this->check_permission(__FUNCTION__);
        if ($is_show == false) {
            jump('', 'pages/permissionList.php','',0);
        } else {
           $per_arr = $result = $_SESSION['permission'];
//            $result = array(array());
//            foreach ($per_arr as $value) {
//                foreach ($result as $val) {
                   
//                }
//            }
//            $offset = 0;
//            $i = 0;
//            $offset_in = 0;
           $max_offset = count($per_arr);
//            $result = array(array());
//            $res_max_offset = count($result);
           /**
            * 这个双重循环是为了排除掉所有的重复权限，common::arrayUnqie为此方法的通用版本，由于问题出在此处，所以保留了代码，方便交流。如果您愿意，完全可以把他扩展成一个通用方法，用于对一个二维数组剔除内部重复一维数组的方法，同时如果再深入重构，也可以
            * 扩展成一个多重循环剔除重复，且可以给它设定在第几层循环中进行剔除的方法
            * 开始的时候我决定使用foreach进行双重遍历，但发现无法实现，因为我无法将第一个foreach中的value值引用到内部的foreach中
            * 于是我改变方法，使用while循环进行双重循环遍历，但是最终发现while循环有一个缺点就是外部的第一个while的偏移量也就是$offset无法被内部的循环二次引用到
            * 打印结果发现while双循环变成了类似0:1,0:2,0:3,0:4....0:33这样的循环，但是无法变成1:1,1:2,1:3,1:4...1:33,也就是第一个值无法递增，它只能当
            * 一个单纯的偏移量来使用
            * 所以，最终我使用双for循环，顺利解决了偏移量无法被内部循环引用二次利用的问题。
            * 从中我对数据的循环有了更加深刻的认识，如果你愿意看我写的代码，我在随后的注释中有一系列在解决该问题过程中写的代码，可以作为参考。我在最后写了一段注释，
            * 是为了解释为什么要这样做。
            * 最后要说明的是在这个内部循环的if中的条件应该有更好的写法，可以尝试修改，条件解读：如果两个数组重复并且两个偏移量不相等并且外循环的偏移量小于内循环的偏移量则执行
            */
           for ($offset = 0; $offset < $max_offset; $offset++) {
               for ($offset_in = 1; $offset_in < $max_offset; $offset_in++) {
                   if (empty(array_diff($per_arr[$offset], $per_arr[$offset_in])) && $offset != $offset_in && $offset<$offset_in){
//                       show($per_arr[$offset]);
//                       show($per_arr[$offset_in]);
//                    echo $offset . ':' . $offset_in;
//                    echo '<br>';
                      unset($result[$offset_in]);
                    }
//                    echo '<hr>';
               }
           }
           $result = lists($result);
           return $result;
//            show($per_arr);
//         foreach ($result as $value) {
//             echo $value['name'];
//             echo '<br>';
//         }
//            show($result);
//            echo '<br>';
//            while ($offset<$max_offset) {
//                while ($offset_in<$max_offset) {
//                foreach ($result as $val) {
//                    show($per_arr[$offset]);
                   
//                     show($val);
//                     $offset_in++;
//                }
//                 $offset_in++;
//            }   
//            $offset++;
//            }            
//                while ($offset_in<$max_offset){
//                    show($per_arr[$offset]);
//                    show($per_arr[$offset_in]);
//                     echo '<hr>';
// echo $offset_in;
// echo '<br>';
//                echo $i;
//                echo '<hr>';
//                        echo $i;
//                    if (empty(array_diff($per_arr[$offset], $per_arr[$offset_in]))){
//                        echo '11';
//                        unset($result[$offset_in]);
//                    }
//                    $offset_in++;
//                $i++;
//                }
//                $offset++;
//            }
//             show($result);
//            while($offset<$max_offset){
//                echo 'offset_in:' . $offset_in;
//                echo '<br>';
//                echo 'offset:' . $offset;
//                echo '<hr>';
//                while ($offset_in<$res_max_offset) {
//                    show($per_arr[$offset]);
//                    show($result[$offset_in]);
//                    if (!empty(array_diff($per_arr[$offset], $result[$offset_in]))){
//                        $result[] = $per_arr[$offset];
//                        $res_max_offset = $res_max_offset+1;
//                    }
//                    $offset_in++;
//                }
//                $offset_in=0;
//                $offset++;
//            }
//             while ($cursor_res<$result_max_offset){
//                 while ($cursor_per<$permission_max_offset){
//                 show($permission_arr[$cursor_per]);
//                 $res = array_diff($permission_arr[$cursor_per], $result[$cursor_res]);
//                 if (!empty($res)){

//                     $result[] = $permission_arr[$cursor_per];
//                 }
//                 $cursor_per++;
//                 }
//                 $cursor_res++;
//             }
//             foreach ($_SESSION['permission'] as $value) {
//                 foreach ($result as $val) {
//                 show($value);
//                     show($value);
//                     show($val);
//                     echo '<hr>';
//                     if (!array_diff($value, $val)){
//                         $result[] = $value;
//                     }
//                 }
//             }
//             $cursor = 0;
//             show($_SESSION['permission']);
//             while ($result = $_SESSION['permission'][$cursor]){
//                 if (!empty($_SESSION['permission'][$cursor])){
//                   echo $cursor++;
//                 }
//             }
//             show($result);
//             $result = lists($_SESSION['permission']);
//             return $result;
            //将显示权限列表功能改成了从session中直接提取，避免从mysql中查询，提高了一点程序的运行效率，这里我们需要考虑的一个问题在于，如何让超级管理员能取得所有的权限
            //因为我们需要考虑的情况比如:当我们为程序新添加了一个功能，而这个功能没有被加入到超级管理员的权限表中，那么超级管理员从session中查询的权限并且显示的权限还是和
            //以前的权限一样，这样就会出现超级管理员都无法控制的权限，所以解决方案是在保存session的那个函数中添加对超级管理员的识别也就是在common::permissionSave()
            //函数中，添加多一个条件，所以这里也体现了超级管理员的唯一性和锁死性，我们需要将超级管理员的识别符添加到配置文件中，才可以起到这样的效果，而且超管在数据库角色表中
            //的id必须要被锁死，禁止进行任何修改才是安全的策略。所以程序流程应该是，我们程序猿->超级管理员->角色管理员（或者无）->普通管理员->用户->游客这样的权限流程，而
            //超管是与我们进行直接交流的角色，其他角色则都是与超管进行交流，一定要明白超管是角色与人的交流，而其他角色是角色与角色的交流。对超管的操作一定要慎重。
//             $mysql = C('mysql');
//             return $mysql->fetchAll('id,name,pid', 'permission');
//             $mysql = C('mysql');
//             $result = $mysql->fetchOne('id,pid,name', 'permission', "id={$_SESSION['uid']}");
//             $results = $this->recursionPermission($result['id']);
//             $results = lists($results, 1);
//             return $results;
        }
    }
    
    /**
     * 递归查询出父权限以及其所有子权限，并以数组形式返回
     * @param number $pid
     * @param array $results
     * @param array $result
     * @return array
     */
//     public function recursionPermission (&$pid, &$results=array(), $result=array()) {
//         $mysql = C('mysql');
//         if (empty($results)){
//             $results[] = $mysql->fetchOne('id,pid,name', 'permission', "id={$pid}");
//         }
//         if (($result = $mysql->fetchAll('id,pid,name', 'permission', "pid={$pid}")) == false) return $results;
//         $results = array_merge_recursive($results, $result);
//         foreach ($result as $value) {
//             self::recursionRole($value['id'], $results);
//         }
//         return $results;
//     }
    
    /**
     * 删除权限
     * @param int $id
     * @throws Exception
     */
    public function delPermission ($id, $rid='') {
        $this->check_permission(__FUNCTION__);
        try {
            if (!is_numeric($id) || empty($id)) throw new Exception('权限删除失败');
            $mysql = C('mysql');
            if ($mysql->fetchOne('pid', 'permission_assignment', "pid={$id}")) {
                if (!$mysql->delete('permission_assignment', "pid={$id}")){
                    throw new Exception('用户权限表删除失败');
                }
            }
            
            if ($mysql->fetchOne('pid', 'permission', "pid={$id}")) {
                if (!$mysql->delete('permission', "pid{$id}")){
                    throw new Exception('权限表子权限删除失败');
                }
            }
            
            if ($mysql->delete('permission', "id={$id}")) {
                jump('删除成功', 'pages/permissionList.php', true);
            } else {
                throw new Exception('权限删除失败');
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/permissionList.php');
        }
    }
    
    /**
     * 编辑权限
     * @param int $id
     * @param string $name
     * @throws Exception
     */
    public function editPermission ($id, $data) {
        $this->check_permission(__FUNCTION__);
        $mysql = C('mysql');
        try {
            if (empty($data['name']) && !is_string($data['name'])) throw new Exception('权限名不能为空');
            if (!is_string($data['fname'])) throw new Exception('权限修改失败');
            $where = "id={$id}";
            if ($mysql->update('permission', $data, $where)){
                jump('权限修改成功', 'pages/permissionList.php', true);
            } else {
                throw new Exception('权限修改失败');
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/permissionList.php');
        }
    }
    
    /**
     * 显示指定权限
     * @param int $id
     */
    public function showPermission ($id) {
        $this->check_permission(__FUNCTION__);
        $mysql = C('mysql');
        return $result = $mysql->fetchOne('id,name,fname', 'permission', "id={$id}");
    }
    

}
?>