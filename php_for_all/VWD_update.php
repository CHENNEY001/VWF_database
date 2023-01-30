<?php

ini_set("display_errors", 0);

header('Content-type:text/html;charset=utf-8');

//var_dump($_POST);

$VWD_type = empty($_POST['VWDtype']) ? '/' : trim($_POST['VWDtype']);
$id = $_POST['id'] !== '' ? (integer)$_POST['id'] : -1;
$mutation_type = empty($_POST['mutation_type']) ? '/' : trim($_POST['mutation_type']);
$Nucleotide_change = empty($_POST['Nucleotide_change']) ? '/' : trim($_POST['Nucleotide_change']);
$Amino_acid_change = empty($_POST['Amino_acid_change']) ? '/' : trim($_POST['Amino_acid_change']);
$Mutant_region = empty($_POST['Mutant_region']) ? '/' : trim($_POST['Mutant_region']);
$Inheritance = empty($_POST['Inheritance']) ? '/' : trim($_POST['Inheritance']);
$Inheritance_related = empty($_POST['Inheritance_related']) ? '/' : trim($_POST['Inheritance_related']);
$Location = empty($_POST['Location']) ? '/' : trim($_POST['Location']);
$APTT = empty($_POST['APTT']) ? '/' : trim($_POST['APTT']);
$VWFAg = empty($_POST['VWF:Ag(%)']) ? '/' : trim($_POST['VWF:Ag(%)']);
$VWFRCo = empty($_POST['VWF:RCo(%)']) ? '/' : trim($_POST['VWF:RCo(%)']);
$RIPA = empty($_POST['RIPA(1_2mg/ml,_%)']) ? '/' : trim($_POST['RIPA(1_2mg/ml,_%)']);
$FVIIIC = empty($_POST['FVIII:C(%)']) ? '/' : trim($_POST['FVIII:C(%)']);
$VWFCB = empty($_POST['VWF:CB(%)']) ? '/' : trim($_POST['VWF:CB(%)']);
$VWFpp = empty($_POST['VWFpp(%)']) ? '/' : trim($_POST['VWFpp(%)']);
$Blood_Type = empty($_POST['BloodType']) ? '/' : trim($_POST['BloodType']);
$Age = empty($_POST['Age']) ? '/' : trim($_POST['Age']);
$Gender = empty($_POST['Gender']) ? '/' : trim($_POST['Gender']);
$BS = empty($_POST['BS']) ? '/' : trim($_POST['BS']);
$Domain = empty($_POST['Domain']) ? '/' : trim($_POST['Domain']);
$Comments = empty($_POST['Comments']) ? '/' : trim($_POST['Comments']);
$References = empty($_POST['References']) ? '/' : trim($_POST['References']);

$permit = isset($_GET['permit']) ? (integer)$_GET['permit'] : 0 ;

if ($permit >= 1){
    header('Refresh:0.5; url=./visit_search.php');
    echo "<script>alert('您没有提交权限')</script>";
    exit();
}

if ($id <= 0 || $VWD_type === '/'){
    header('Refresh:0.5; url=../html/add.html');
    echo "<script>alert('id和VWD type均不能为空')</script>";
    exit();
}

//$Permit = "<script>document.write(id);</script>";
//echo $Permit;
//
//if (strstr($Permit,"2" )==0){
//    echo "<script>postToPage(2)</script>";
//    header("Refresh:0.5; url=../php_for_all/main_search.php");
//    echo "<script>alert('您没有编辑权限')</script>";
//    exit();
//}

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";

$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

include '../database.php';

$sql_check = "select * from vwf where id = " . $id;
$res = mysqli_query($con, $sql_check);

if(mysqli_num_rows($res) < 1){
    header("Refresh:0.5; url=./main_search.php?permit=$permit");
    echo "<script>alert('病人id不存在')</script>";
    exit();
}

//$sql = "insert into (`ID`,`Mutant_region`,`VWD_type`,`Mutation_type`,`Inheritance`,`Inheritance_related`,`Location`,`Nucleotide_change`,`Amino_acid_exchange`,`APTT`,`VWF:Ag(%)`,`VWF:RCo(%)`,`RIPA(1.2 mg/ml, %)`,`FVIII:C(%)`,`VWF:CB(%)`,`VWFpp(%)`,`Age`,`Gender`,`Blood_type`,`BS`,`Domain`,`References`,`Comments`) vwf values($id, '$Mutant_region', '$VWD_type', '$mutation_type', '$Inheritance', '$Inheritance_related', '$Location', '$Nucleotide_change', '$Amino_acid_change', '$APTT', '$VWFAg', '$VWFRCo', '$RIPA', '$FVIIIC', '$VWFCB', '$VWFpp', '$Age', '$Gender', '$Blood_Type', '$BS', '$Domain', '$References', '$Comments')";
$sql = "update vwf set `Mutant_region` = '$Mutant_region', `VWD_type` = '$VWD_type', `Mutation_type` = '$mutation_type', `Inheritance` = '$Inheritance', `Inheritance_related` = '$Inheritance_related', `Location` = '$Location', `Nucleotide_change` =  '$Nucleotide_change', `Amino_acid_exchange` = '$Amino_acid_change', `APTT` = '$APTT', `VWF:Ag(%)` = '$VWFAg', `VWF:RCo(%)` = '$VWFRCo', `RIPA(1.2 mg/ml, %)`= '$RIPA', `FVIII:C(%)` = '$FVIIIC', `VWF:CB(%)` = '$VWFCB', `VWFpp(%)` = '$VWFpp', `Age` = '$Age', `Gender` = '$Gender', `Blood_type` = '$Blood_Type', `BS` = '$BS', `Domain` = '$Domain', `References` = '$References', `Comments` = '$Comments' where id = {$id}";

my_error($con, $sql);

header("Refresh:0.5; url=../php_for_all/main_search.php?permit=$permit");
echo "<script>alert('突变数据修改成功')</script>";
exit();
