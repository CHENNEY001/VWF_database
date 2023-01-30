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

$ID = isset($_GET['ID']) ? (integer)$_GET['ID'] : -1 ;
$permit = isset($_GET['permit']) ? (integer)$_GET['permit'] : 0 ;
//echo $permit;
//$Permit = "<script>document.write(id);</script>";
//
//if (strstr($Permit,"2" )==0){
//    echo "<script>postToPage(2)</script>";
//}
//echo $Permit;

$sql = "select * from vwf where ID = " . $ID;

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

$tmp = $records[0];
$tag = $tmp['tag'];

if ($tag === "2" && $permit >= 1){
    header("Refresh:0.5; url=../php_for_all/mutation_search.php?ID=$ID&permit=$permit");
    echo "<script>alert('您没有访问该病例临床数据的权限')</script>";
    exit();
}

if ($tag === "1"){
    header("Refresh:0.5; url=../php_for_all/mutation_search.php?ID=$ID&permit=$permit");
    echo "<script>alert('您没有访问该病例临床数据的权限')</script>";
    exit();
}

include_once '../html/template_patient.html';
