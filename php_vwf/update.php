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

$id = isset($_GET['id']) ? (integer)$_GET['id'] : -1 ;

if ($id <= 0){
    header('Refresh:0.5; url=../php_vwf/search.php');
    echo "<script>alert('当前要编辑的患者id不存在')</script>";
    exit();
}

$sql = "select * from mutation where id = " . $id;

$res = mysqli_query($con, $sql);
$mutation = mysqli_fetch_assoc($res);

include_once '../html/mutation_edit.html';
