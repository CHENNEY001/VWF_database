<?php

ini_set("display_errors", 0);

header('Content-type:text/html;charset=utf-8');

//var_dump($_POST);

$VWD_type = empty($_POST['VWDtype']) ? '/' : trim($_POST['VWDtype']);
$Mutant_region = empty($_POST['Mutant_region']) ? '/' : trim($_POST['Mutant_region']);
$mutation_type = empty($_POST['mutation_type']) ? '/' : trim($_POST['mutation_type']);
$Nucleotide_change = empty($_POST['Nucleotide_change']) ? '/' : trim($_POST['Nucleotide_change']);
$Amino_acid_change = empty($_POST['Amino_acid_change']) ? '/' : trim($_POST['Amino_acid_change']);
$Inheritance = empty($_POST['Inheritance']) ? '/' : trim($_POST['Inheritance']);
$Inheritance_related = empty($_POST['Inheritance_related']) ? '/' : trim($_POST['Inheritance_related']);
$Location = empty($_POST['Location']) ? '/' : trim($_POST['Location']);
$Domain = empty($_POST['Domain']) ? '/' : trim($_POST['Domain']);
$Comments = empty($_POST['Comments']) ? '/' : trim($_POST['Comments']);
$References = empty($_POST['References']) ? '/' : trim($_POST['References']);
$Plasma_multimers = empty($_POST['Plasma_multimers']) ? '/' : trim($_POST['Plasma_multimers']);
$In_vitro_multimers = empty($_POST['In_vitro_multimers']) ? '/' : trim($_POST['In_vitro_multimers']);
$Increased_clearance = empty($_POST['Increased_clearance']) ? '/' : trim($_POST['Increased_clearance']);
$Decreased_secretion_in_vitro = empty($_POST['Decreased_secretion_in_vitro']) ? '/' : trim($_POST['Decreased_secretion_in_vitro']);
$Extra_remarks = empty($_POST['Extra_remarks']) ? '/' : trim($_POST['Extra_remarks']);

$permit = isset($_GET['permit']) ? (integer)$_GET['permit'] : 0 ;
//echo "$permit";
if ($permit >= 1){
    header("Refresh:0.5; url=./mmc.php?permit=$permit");
    echo "<script>alert('您没有提交权限')</script>";
    exit();
}

if ($VWD_type === '/'){
    header("Refresh:0.5; url=../html/add_mmc.html");
    echo "<script>alert('VWD type不能为空')</script>";
    exit();
}

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";

$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

include '../database.php';

//$sql = "insert into (`ID`,`Mutant_region`,`VWD_type`,`Mutation_type`,`Inheritance`,`Inheritance_related`,`Location`,`Nucleotide_change`,`Amino_acid_exchange`,`APTT`, `Age`,`Gender`,`Blood_type`,`BS`,`Domain`,`References`,`Comments`) vwf values($id, '$Mutant_region', '$VWD_type', '$mutation_type', '$Inheritance', `$Inheritance_related`, '$Location', '$Nucleotide_change', '$Amino_acid_change', '$APTT', '$VWFAg', '$VWFRCo', '$RIPA', '$FVIIIC', '$VWFCB', '$VWFpp', '$Blood_Type', '$Age', '$Gender', '$BS', '$Domain', '$References', '$Comments')";
$sql = "insert into mmc (`VWD_type`, `Mutant_region`, `Mutation_type`, `Amino_acid_exchange`, `Nucleotide_change`, `Inheritance`, `Inheritance_related`, `Domain`, `Location`, `Plasma_multimers`, `In_vitro_multimers`, `Increased_clearance`, `Decreased_secretion_in_vitro`, `Extra_remarks`, `References`, `Comments`) values('$VWD_type', '$Mutant_region', '$mutation_type', '$Amino_acid_change', '$Nucleotide_change', '$Inheritance', '$Inheritance_related', '$Domain', '$Location', '$Plasma_multimers', '$In_vitro_multimers', '$Increased_clearance', '$Decreased_secretion_in_vitro', '$Extra_remarks', '$References', '$Comments')";

my_error($con, $sql);

header("Refresh:0.5; url=./mmc.php?permit=$permit", $replace=false);
echo "<script>alert('突变数据提交成功')</script>";
exit();
