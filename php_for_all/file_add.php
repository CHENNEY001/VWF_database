<?php

ini_set("display_errors", 0);

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";
$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
include '../database.php';

//if($_FILES["userFile"]==''){
//    echo "上传文件失败";
//    exit();
//}
//var_dump($_POST);
//echo "<hr>";
//var_dump($_FILES);
//echo "<hr>";

$permit = isset($_GET['permit']) ? (integer)$_GET['permit'] : 0 ;
$csv_filename = $_FILES["userFile"]["name"];
$dir = "./upload/";
if (is_dir($dir) == false) {
    mkdir($dir, 0777);
}
$info = move_uploaded_file($_FILES["userFile"]["tmp_name"], $dir . $csv_filename);

$csv_file = fopen($dir.$csv_filename, 'r');

$bigArray = [];
$i = 0;
if (($h = fopen($dir.$csv_filename, 'r')) !== FALSE){
    while(($data = fgetcsv($h, 1000, ",")) !== FALSE){
        $bigArray[]=$data;
        $VWD_type_file = $bigArray[$i][2];
        $id_file = (integer)$bigArray[$i][0];
        $mutation_type_file = $bigArray[$i][3];
        $Nucleotide_change_file = $bigArray[$i][7];
        $Amino_acid_change_file = $bigArray[$i][8];
        $Mutant_region_file = $bigArray[$i][1];
        $Inheritance_file = $bigArray[$i][4];;
        $Inheritance_related_file = $bigArray[$i][5];;
        $Location_file = $bigArray[$i][6];
        $APTT_file = $bigArray[$i][9];
        $VWFAg_file = $bigArray[$i][10];
        $VWFRCo_file = $bigArray[$i][11];
        $RIPA_file = $bigArray[$i][12];
        $FVIIIC_file = $bigArray[$i][13];
        $VWFCB_file = $bigArray[$i][14];
        $VWFpp_file = $bigArray[$i][15];
        $Blood_Type_file = $bigArray[$i][18];
        $Age_file = $bigArray[$i][16];
        $Gender_file = $bigArray[$i][17];
        $BS_file = $bigArray[$i][19];
        $Domain_file = $bigArray[$i][20];
        $Comments_file = $bigArray[$i][22];
        $References_file = $bigArray[$i][21];
        $VWFRCoVWFAg_file = $bigArray[$i][23];
        $FVIIICVWFAg_file = $bigArray[$i][24];
        $VWFCBVWFAg_file = $bigArray[$i][25];
        $VWFppVWFAg_file = $bigArray[$i][26];
        $tag = $bigArray[$i][27];
        $sql_insert = "insert into vwf values('$id_file', '$Mutant_region_file', '$VWD_type_file', '$mutation_type_file', '$Inheritance_file', '$Inheritance_related_file', '$Location_file', '$Nucleotide_change_file', '$Amino_acid_change_file', '$APTT_file', '$VWFAg_file', '$VWFRCo_file', '$RIPA_file', '$FVIIIC_file', '$VWFCB_file', '$VWFpp_file', '$Age_file', '$Gender_file', '$Blood_Type_file', '$BS_file', '$Domain_file', '$References_file', '$Comments_file', '$VWFRCoVWFAg_file', '$FVIIICVWFAg_file', '$VWFCBVWFAg_file', '$VWFppVWFAg_file', '$tag')";
        if ($i>=1){
            my_error($con, $sql_insert);
        }
        $i ++;
    }
    fclose($h);
}

header("Refresh:0.5; url=./main_search.php?permit='$permit'", $replace=false);
echo "<script>alert('突变数据提交成功')</script>";
exit();
