<?php 
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . 'rbac/' . 'config.php';

$my = array('aaa','ccc');
$you = array('aaa','bbb');
show(array_diff($my, $you));
die;
$array = array(array(1,1,2),array(2,3,4,3));


/**
 * 如果$my>$you返回$my中多余的数组
 * 如果$my=$you返回空数组
 * 如果$my<$you返回空数组
 * 如果$my<>$you返回$my中多余的数组
 */
$temp_array = array();
foreach($array as $key=>$value){

    $temp_array[$key] = array_unique($value);
}

$array = $temp_array;
show($array);
die;
$a = array(
    array('aaa','bbb'),
    array('aaa','bbb','ccc')
);
$b = array(
    array('aaa','bbb'),
    array('aaa','bbb','ccc'),
    array('aaa','bbb')
);
show($b);
$re = array_diff($a[0], $b[2]);
if (empty($re)){
    unset($b[2]);
}
show($b);
var_dump($re);
die;
$c = array_diff($a,$b);
var_dump($c);
if (empty($c)){
    echo 'ok';
}
// if (array_diff($a, $b)){
//     show($c);
//     echo '两个数组相当';
// }

die;
$test = $_SESSION['permission'];
$result = array();
foreach ($test as $value) {
    foreach ($result as $val) {
        if (array_diff($val, $value)) {
            $result[] = $value;
        }
    }
}
show($result);
die;
$sql = "select count(id) from permission";
// $mysql = C('mysql');
// $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
// $res = mysqli_query($conn, $sql);
// $row = mysqli_fetch_row($res);
// show($row);


function page ($sql,$id=1, $limit=5) {
    $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);    
    $res = $mysqli->query($sql);
    $row = $res->fetch_row();
    $row = $row[0];
    show($row);
    $sqlToShow = "select id from permission limit {$id},5";
    $res_list = $mysqli->query($sqlToShow);
    $result_list = $res_list->fetch_all();
    show($result_list);
}


page($sql, $_GET['id']);
// $arr = array(
//     'id' => 1,
//     'rid' => 2,

//     'name' => 'sdfsdfdsf'
// );
// $arr = array(
//     'sssid' => 1222,
//     'rid' => 2,
//     'name' => 'sdfsdfdsf',
//         'naamae' => 'sdfsdfdsf',
//     'namae' => 'sdfsdfdsf'
// );
// $arr2 = array(
//     'id' => 1,
//     'rid' => 2,
//     'name' => 'sdfsdfdsf',
//     'nasme' => 'sdfsdfdsf',
//     'namae' => 'sdfsdfdsf'
// );
// $old_keys = array(
//     'isd',
//     'rid',
//     'name',
//     'nasme',
//     'namae'
// );
// $new_keys = array(
//     'new_id',
//     'new_rid',
//     'new_name',
//     'new_nasme',
//     'new_namae'
// );

// show($arr);
// unset($arr['rid']);
// show($arr);
// $arrayIterator = new ArrayIterator($arr2);
// $arrayIterator->append('sdfsdf');
// $arr2_new = $arrayIterator->getArrayCopy();
// foreach ($arrayIterator as $key => $value) {
//     $arr2_new[$key] = $value;
// }
// show($arr2_new);
// $arrayObject = new ArrayObject($arr2);
// $arr2_new = $arrayObject->exchangeArray($arr);
// $arr2_new = $arrayObject->getArrayCopy();

// show($arr2_new);

// $new_arr2 = keysConventer($arr2, 'id', 'id_new');
// show($new_arr2);



// $a = 1;
// class test {
//     public function func ($value) {
//         if (!empty($value)){
//             if ($value === 1) {
//                 return '等于1';
//             }
//         }
//         return '我在继续执行';
//     }
// }

// $test = new test();
// $res = $test->func($a);
// echo $res;


// $a = 0;
// $b = 1;
// if (isset($a)) echo 'a';
// if (!empty($a)) echo 'a';



// $arrays = array(
//     0 => array(
//         'id' => 1,
//         'pid' => 0
//     ),
//     1 => array(
//         'id' => 2,
//         'pid' => 1
//     ),
//     2 => array(
//         'id' => 3,
//         'pid' => 1
//     ),
//     3 => array(
//         'id' => 4,
//         'pid' => 2
//     ),
// );


// show($arrays);







?>
<!DOCTYPE a PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
</head>
<body>
sdfsdfsdf
<br>
<a href="?id=1">1</a>
<a href="?id=2">2</a>
<a href="?id=3">3</a>
<a href="?id=4">4</a>
</body>
</html>
