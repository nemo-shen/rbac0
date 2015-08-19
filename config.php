<?php 
session_start();
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 'root');
define('DBNAME', 'rbac');
define('DBPORT', 3306);
define('DBCHAR', 'utf8');
define('DIRNAME', $_SERVER['CONTEXT_DOCUMENT_ROOT'] . 'rbac/');
define('USERPER_ROLE_ID', 1);
define('NORMAL_ROLE_ID', 3);
header("Content-type:text/html; charset=utf-8");
require_once 'class/common.class.php';
/**
 * 以下所有方法都可以将其放置到common.class.php文件中，由于开发的时候没有进行处理，所以没有放入common.class.php文件中
 */

/**
 * 开发时候用于显示参数的函数，可删除，没有任何影响
 * @param string|int|bool|array|object $var
 */
function show ($var) {
    if (is_array($var) || is_object($var)){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    } else {
        echo $var;
    }
}

/**
 * 跳转页面函数
 * @param string $message
 * @param url $destination 当使用此函数是以此文件为URL的基准点进行跳转
 * @param string $is_true
 * @param number $time
 */
function jump ($message='', $destination, $is_true=false, $time=1000) {
    if ($time === 0){
        echo "<script>location.href='{$destination}';</script>";
    } else {
        
    echo <<<EOF
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <script>setTimeout("location.href='{$destination}'",{$time});</script>
    </head>
    <body>
        {$message} </br>
EOF;
    if ($is_true) {
        echo '<span style="font-size:130px;">&nbsp;&nbsp;:)</span>';
    } else {
        echo '<span style="font-size:130px;">&nbsp;&nbsp;:(</span>';
    }
    echo <<<EOF
    </body>
    </html>
EOF;
    }
}

/**
 * 检查用户是否已经登陆
 * @param string $destination
 */
function checkLogined($destination='login.html'){
    if (!isset($_SESSION['uid']) || !isset($_SESSION['username']) || !isset($_SESSION['permission'])) {
        jump('没有找到该页面', $destination);
    }
}

/**
 * 自动实例化类函数
 * @param string $className
 * @param array $parameter
 * @return object
 * 这个函数是开始开发时没有想到的，所以mysql被独立出来了，这样的做法并不好，如果有兴趣可以对其进行改进，不会有任何影响
 */
function C ($className, $parameter=array()) {
    require_once DIRNAME . "class/{$className}.class.php";
    if ($className === 'mysql'){
        return new $className(DBHOST,DBUSER,DBPASS,DBNAME,DBCHAR);
    } else {
        if (!empty($parameter)){
            return new $className($parameter);
        }
        else {
            return new $className();
        } 
    }
}

/**
 * 对字符串进行转义
 * @param string $str
 * @return string|string
 */
function addslashesed($str) {
    if (get_magic_quotes_gpc()) {
        return $str;
    } else {
        return addslashes($str);
    }
}

/**
 * ******二维数组数组格式********利用递归处理数组格式，使用范围在分类列表等需要无线分类的场合
 * @param array $data
 * @param number $pid
 * @param string $modifier
 * @return array
 */
// function lists ($data, &$result=array(), $pid=0, $cursor=0, $modifier='|—'){
//     if (!$data) return false;
//     $cursor++;
//     foreach ($data as $key => $value) {
//         if ($value['pid'] == $pid) {
//             $value['name'] = str_repeat("&nbsp;&nbsp;&nbsp;", $cursor) . $modifier . $value['name'];
//             $result[] = $value;
//             lists($data, $result, $value['id'], $cursor);
//         }
//     }
    
//     return $result;
// }
function lists ($data, $pid=0, &$result=array(), $cursor=0, $modifier='|—'){
    if (!$data) return false;
    $cursor++;
    foreach ($data as $key => $value) {
        if ($value['pid'] == $pid) {
            $value['name'] = str_repeat("&nbsp;&nbsp;&nbsp;", $cursor) . $modifier . $value['name'];
            $result[] = $value;
            lists($data, $value['id'], $result, $cursor);
        }
    }

    return $result;
}
/**
 * ******嵌套循环数组格式********利用递归处理数组格式，使用范围在分类列表等需要无线分类的场合
 * @param array $data
 * @param number $pid
 * @param string $modifier
 * @return array
 */
// function lists ($data, $pid=0, $modifier='|'){
//     $datas = array();
//     $modifier .= "—";
//     foreach ($data as $key => $value) {
//         if ($value['pid'] == $pid) {
//             $value['name'] =  $modifier . $value['name'];
//             $value['list'] = lists($data, $value['id'], $modifier); // 递归关键点，将查出来符合条件的数组压到父数组的list字段下
//             $datas[] = $value;

//         }
//     }
//     return $datas;
// }


/**
 * 数组键名转换器，用于把数组中的原键名改成能够使用的键名
 * @param array $des_array
 * @param string||int $old_key
 * @param string||int $new_key
 */
function keysConventer ($src_array, $old_key, $new_key) {
    try {
        if (empty($src_array)) throw new Exception('必须有目标数组');
        if (is_array($old_key) && is_array($new_key)) {
            if ((count($new_key) - count($old_key)) !== 0) throw new Exception('替换键与原键数量不一致');
            $i=0;
            foreach ($src_array as $value) {
                $src_array[$i] = $value;
                $i++;
            }
            for ($i = 0; $i < count($old_key); $i++) {
                if (array_key_exists($old_key[$i], $src_array)){
                    $des_array[$new_key[$i]] = $src_array[$old_key[$i]];
                } else {
                    $des_array[$new_key[$i]] = $src_array[$i];
                }
            }
            return $des_array;
        } elseif (is_string($old_key) && is_string($new_key)) {
            if (!array_key_exists($old_key, $src_array)) throw new Exception('数组中没有这个key值，请检查');
            foreach ($src_array as $key => $value) {
                if ($old_key !== $key) $des_array[$key] = $value;
            }
            $des_array[$new_key] = $src_array[$old_key];
            return $des_array;
        } else {
            throw new Exception('无法进行正确替换,请检查错误');
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

/**
 * 取得特定PID下的所有子ID
 * @param unknown $pid
 */
function AllAssocPermission ($data, &$pid, $id, &$result=array()) {
    foreach ($data as $value) {
        if ($value['pid'] == $pid) {
            $result[] = $value;
            AllAssocPermission($data, $value['id'],'', $result);
        }
        if ($value['id'] == $id) {
            $result[] = $value;
        }
    }
    return $result;
}

/**
 * 将多维数组转化成一维数组
 * @param array $data
 * @param array $results
 * @param number $offset
 * @return array
 */
function multiToOneArray ($data, &$results = array(), $offset=0) {
    foreach ($data as $key=>$value) {
        if (is_array($data) && !is_array($value) && $offset==0){
            $results[] = $data;
        }
        if (is_array($data) && is_array($value)) {
            multiToOneArray($value, $results);
        }
        $offset++;
    }
    return $results;
}

?>