<?php
ini_set("display_errors", 0);
header('Content-type:text/html;charset=utf-8');

$APTT = empty($_POST['APTT']) ? '/' : trim($_POST['APTT']);
$id = $_POST['id'] !== '' ? (integer)$_POST['id'] : -1;
$VWFAg = empty($_POST['VWF:Ag(%)']) ? '/' : trim($_POST['VWF:Ag(%)']);
$VWFRCo = empty($_POST['VWF:RCo(%)']) ? '/' : trim($_POST['VWF:RCo(%)']);
$RIPA = empty($_POST['RIPA(1_2mg/ml,_%)']) ? '/' : trim($_POST['RIPA(1_2mg/ml,_%)']);
$FVIII = empty($_POST['FVIII:C(%)']) ? '/' : trim($_POST['FVIII:C(%)']);
$VWFCB = empty($_POST['VWF:CB(%)']) ? '/' : trim($_POST['VWF:CB(%)']);
$VWFpp = empty($_POST['VWFpp(%)']) ? '/' : trim($_POST['VWFpp(%)']);
$Blood_Type = empty($_POST['Blood_Type']) ? '/' : trim($_POST['Blood_Type']);
$Age = $_POST['Age'] !== '' ? trim($_POST['Age']) : '/';
$Gender = empty($_POST['Gender']) ? '/' : trim($_POST['Gender']);
$BS = empty($_POST['BS']) ? '/' : trim($_POST['BS']);

//echo '<br>', $id, '<br>', $VWD_type, '<br>', $table_type, '<br>';
if ($id <= 0){
    header('Refresh:0.5; url=../html/patient_add.html');
    echo "<script>alert('patient id不能为空')</script>";
    exit();
}

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";

$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

include '../database.php';

$sql_check = "select * from patient where id = " . $id;
$res = mysqli_query($con, $sql_check);
if(mysqli_num_rows($res) > 0){
    header('Refresh:0.5; url=./patient_search.php');
    echo "<script>alert('病人id已经存在')</script>";
    exit();
}

$sql = "insert into patient values($id, '$APTT ', '$VWFAg', '$VWFRCo', '$RIPA', '$FVIII', '$VWFCB', '$VWFpp', '$Blood_Type', '$Age', '$Gender', '$BS')";

my_error($con,'set names utf8');
my_error($con, $sql);

header('Refresh:0.5; url=./patient_search.php', $replace=false);
echo "<script>alert('病人数据提交成功')</script>";
exit();
//my_error();