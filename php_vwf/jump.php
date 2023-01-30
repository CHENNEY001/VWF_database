<?php
ini_set("display_errors", 0);

header('Content-type:text/html;charset=utf-8');

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";

$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

include '../database.php';

my_error($con,'set names utf8');

header('Refresh:0; url=../html/mutation_add.html');