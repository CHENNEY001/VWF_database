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

$sql = "select * from vwf where ID =" . $ID;

$result = mysqli_query($con, $sql);
if(!$result){
    echo "SQL指令执行出错";
    exit();
}

$records = array(); // 保存记录
//$number = 0;

$num = mysqli_num_rows($result);
for ($i=0; $i < $num; $i++){
    $records[] = mysqli_fetch_assoc($result);
//    $amino = $records[$i]['Amino_acid_exchange'];
//    $Nucleotide = $records[$i]['Nucleotide_change'];
//    $type = $records[$i]['VWD_type'];
//    $sql_similar = "select * from mmc where VWD_type = {$type} AND ( Amino_acid_exchange like '%{$amino}%' OR Nucleotide_change like '%{$Nucleotide}%')";
//    $result_similar = mysqli_query($con, $sql_similar);
//    $number = mysqli_num_rows($result_similar);
//    for ($j=0; $j < $number; $j++){
//        $res[$i][] = mysqli_fetch_assoc($result_similar);
//    }
}

include_once '../html/template_mutation.html';
