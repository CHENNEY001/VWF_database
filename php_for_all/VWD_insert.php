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
$tag= empty($_POST['tag']) ? '/' : trim($_POST['tag']);

if ($VWFAg == '/'){
    $ratio1 = '/';
    $ratio2 = '/';
    $ratio3 = '/';
    $ratio4 = '/';
}else{
    $VWFAg = round((float)$VWFAg, 2);
    if ($VWFRCo == '/'){
        $ratio1 = '/';
    }else{
        $VWFRCo = round((float)$VWFRCo, 2) ;
        $ratio1 = round((float)$VWFRCo/(float)$VWFAg, 2) ;
    }
    if ($FVIIIC == '/'){
        $ratio2 = '/';
    }else{
        $FVIIIC = round((float)$FVIIIC, 2) ;
        $ratio2 = round((float)$FVIIIC/(float)$VWFAg, 2) ;
    }
    if ($VWFCB == '/'){
        $ratio3 = '/';
    }else{
        $VWFCB = round((float)$VWFCB, 2) ;
        $ratio3 = round((float)$VWFCB/(float)$VWFAg, 2) ;
    }
    if ($VWFpp == '/'){
        $ratio4 = '/';
    }else{
        $VWFpp = round((float)$VWFpp, 2) ;
        $ratio4 = round((float)$VWFpp/(float)$VWFAg, 2) ;
    }
}

$permit = isset($_GET['permit']) ? (integer)$_GET['permit'] : 0 ;
//echo "$permit";
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

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";

$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

include '../database.php';

//$sql_check = "insert into vwf values('300', '/', '1', '/', '/', `/`, '$Location', '$Nucleotide_change', '$Amino_acid_change', '$APTT', '$VWFAg', '$VWFRCo', '$RIPA', '$FVIIIC', '$VWFCB', '$VWFpp', '$Blood_Type', '$Age', '$Gender', '$BS', '$Domain', '$References', '$Comments')";
//$res = mysqli_query($con, $sql_check);
//print_r($res);
//if(mysqli_num_rows($res) > 0){
//    header('Refresh:0.5; url=./main_search.php');
//    echo "<script>alert('病人id已经存在')</script>";
//    exit();
//}

//$sql = "insert into (`ID`,`Mutant_region`,`VWD_type`,`Mutation_type`,`Inheritance`,`Inheritance_related`,`Location`,`Nucleotide_change`,`Amino_acid_exchange`,`APTT`,`VWF:Ag(%)`,`VWF:RCo(%)`,`RIPA(1.2 mg/ml, %)`,`FVIII:C(%)`,`VWF:CB(%)`,`VWFpp(%)`,`Age`,`Gender`,`Blood_type`,`BS`,`Domain`,`References`,`Comments`) vwf values($id, '$Mutant_region', '$VWD_type', '$mutation_type', '$Inheritance', `$Inheritance_related`, '$Location', '$Nucleotide_change', '$Amino_acid_change', '$APTT', '$VWFAg', '$VWFRCo', '$RIPA', '$FVIIIC', '$VWFCB', '$VWFpp', '$Blood_Type', '$Age', '$Gender', '$BS', '$Domain', '$References', '$Comments')";
$sql = "insert into vwf values('$id', '$Mutant_region', '$VWD_type', '$mutation_type', '$Inheritance', '$Inheritance_related', '$Location', '$Nucleotide_change', '$Amino_acid_change', '$APTT', '$VWFAg', '$VWFRCo', '$RIPA', '$FVIIIC', '$VWFCB', '$VWFpp', '$Age', '$Gender', '$Blood_Type', '$BS', '$Domain', '$References', '$Comments', '$ratio1', '$ratio2', '$ratio3', '$ratio4', '$tag')";

my_error($con, $sql);

header("Refresh:0.5; url=./main_search.php?permit='$permit'", $replace=false);
echo "<script>alert('突变数据提交成功')</script>";
exit();