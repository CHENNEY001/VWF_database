<?php
ini_set("display_errors", 0);

//连接数据库
$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";

$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
if(!$con){
    die("error:".mysqli_connect_error());//返回最近调用函数的最后一个错误描述。
} //如果连接失败就报错并且中断程序
mysqli_query($con , "set names utf8");

$sql = "select * from mutation order by id asc";

$result = mysqli_query($con, $sql);
if(!$result){
    echo "SQL指令执行出错";
    exit();
}

$mutations = array(); // 保存记录

$num = mysqli_num_rows($result);
for ($i=0; $i < $num; $i++){
    $mutations[] = mysqli_fetch_assoc($result);
}

include_once '../html/mutation.html';

//while($mutation[] = mysqli_fetch_assoc($result)){
//}

//echo '<pre>';
//var_dump($mutation); // 查看列数
//echo '<br>', $result->fetch_field_direct(1)->name; //看表头
//
////var_dump($result); //不报错只能证明sql语句是正确的
//
////$rows = mysqli_num_rows($result);
////echo $rows;
//
//$row = mysqli_fetch_assoc($result); //关联数组
//
//while($row) {
//    print_r($row);
//    $row = mysqli_fetch_row($result); //索引数组
//}
//
//mysqli_data_seek($result, 0);
//$row = mysqli_fetch_array($result);
//while($row) {
//    print_r($row);
//    $row = mysqli_fetch_array($result); //关联数组+索引数组
//}

