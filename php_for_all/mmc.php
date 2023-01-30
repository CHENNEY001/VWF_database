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

$sql = "select * from mmc";
$permit = isset($_GET['permit']) ? (integer)$_GET['permit'] : 0 ;
//echo "$permit";

$result = mysqli_query($con, $sql);
if(!$result){
    echo "SQL指令执行出错";
    exit();
}

$records = array(); // 保存记录

$num = mysqli_num_rows($result);
for ($i=0; $i < $num; $i++){
    $records[] = mysqli_fetch_assoc($result);
}

include_once '../html/mmc.html';

