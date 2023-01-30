<?php

ini_set("display_errors", 0);

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";
$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
include '../database.php';

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
        $VWD_type_file = $bigArray[$i][0];
        $Mutant_region_file = $bigArray[$i][1];
        $mutation_type_file = $bigArray[$i][2];
        $Amino_acid_change_file = $bigArray[$i][3];
        $Nucleotide_change_file = $bigArray[$i][4];
        $Inheritance_file = $bigArray[$i][5];
        $Inheritance_related_file = $bigArray[$i][6];
        $Domain_file = $bigArray[$i][7];
        $Location_file = $bigArray[$i][8];
        $Plasma_multimers_file = $bigArray[$i][9];
        $In_vitro_multimers_file = $bigArray[$i][10];
        $Increased_clearance_file = $bigArray[$i][11];
        $Decreased_secretion_in_vitro_file = $bigArray[$i][12];
        $Extra_remarks_file = $bigArray[$i][13];
        $References_file = $bigArray[$i][14];
        $Comments_file = $bigArray[$i][15];
        $sql_insert = "insert into mmc (`VWD_type`, `Mutant_region`, `Mutation_type`, `Amino_acid_exchange`, `Nucleotide_change`, `Inheritance`, `Inheritance_related`, `Domain`, `Location`, `Plasma_multimers`, `In_vitro_multimers`, `Increased_clearance`, `Decreased_secretion_in_vitro`, `Extra_remarks`, `References`, `Comments`) values('$VWD_type_file', '$Mutant_region_file', '$mutation_type_file', '$Amino_acid_change_file', '$Nucleotide_change_file', '$Inheritance_file', '$Inheritance_related_file', '$Domain_file', '$Location_file', '$Plasma_multimers_file', '$In_vitro_multimers_file', '$Increased_clearance_file', '$Decreased_secretion_in_vitro_file', '$Extra_remarks_file', '$References_file', '$Comments_file')";
        if ($i>=1){
            my_error($con, $sql_insert);
        }
        $i ++;
    }
    fclose($h);
}

header("Refresh:0.5; url=./mmc.php?permit=$permit", $replace=false);
echo "<script>alert('突变数据提交成功')</script>";
exit();

