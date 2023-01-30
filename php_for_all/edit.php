<?php

ini_set("display_errors", 0);

header('Content-type:text/html;charset=utf-8');

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

$ID = isset($_GET['ID']) ? (integer)$_GET['ID'] : -1 ;
$permit = isset($_GET['permit']) ? (integer)$_GET['permit'] : 0 ;
//var_dump($_GET);

if ($permit == 1){
    header("Refresh:0.5; url=../php_for_all/main_search.php?permit=$permit");
    echo "<script>alert('您没有编辑权限')</script>";
    exit();
}

if ($ID <= 0){
    header("Refresh:0.5; url=../php_for_all/main_search.php?permit=$permit");
    echo "<script>alert('当前要编辑的患者id不存在')</script>";
    exit();
}

$sql = "select * from vwf where ID =" . $ID;

$res = mysqli_query($con, $sql);
$record = mysqli_fetch_assoc($res);

include_once '../html/edit.html';
