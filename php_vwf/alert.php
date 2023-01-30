<?php
ini_set("display_errors", 0);

header('Content-type:text/html;charset=utf-8');

$VWD_type = empty($_POST['VWD_type']) ? '/' : trim($_POST['VWD_type']);
$id = $_POST['id'] !== '' ? (integer)$_POST['id'] : -1;
$mutation_type = empty($_POST['mutation_type']) ? '/' : trim($_POST['mutation_type']);
$Nucleotide_change = empty($_POST['Nucleotide_change']) ? '/' : trim($_POST['Nucleotide_change']);
$Amino_acid_change = empty($_POST['Amino_acid_change']) ? '/' : trim($_POST['Amino_acid_change']);
$Mutant_region = empty($_POST['Mutant_region']) ? '/' : trim($_POST['Mutant_region']);
$Inheritance = empty($_POST['Inheritance']) ? '/' : trim($_POST['Mutant_region']);
$Location = empty($_POST['Location']) ? '/' : trim($_POST['Location']);
$Comments = empty($_POST['Comments']) ? '/' : trim($_POST['Comments']);
$References = empty($_POST['References']) ? '/' : trim($_POST['References']);

//echo '<br>', $id, '<br>', $VWD_type, '<br>', $table_type, '<br>';
if ($id <= 0 || $VWD_type === '/'){
    header('Refresh:2.5; url=../html/mutation_add.html');
    echo "<script>alert('id和VWD type均不能为空')</script>";
}

$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";

$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

include '../database.php';

$sql_check = "select * from mutation where id = " . $id;
$res = mysqli_query($con, $sql_check);
if(mysqli_num_rows($res) < 1){
    header('Refresh:0.5; url=./search.php');
    echo "<script>alert('病人id不存在')</script>";
    exit();
}

$sql = "update mutation set `Mutant region` = '$Mutant_region', `VWD type` = '$VWD_type', `Mutation type` = '$mutation_type', `Inheritance` = '$Inheritance', `Location` = '$Location', `Nucleotide change` = '$Nucleotide_change', `Amino acid exchange` = '$Amino_acid_change', `References` = '$References', `Comments` = '$Comments' where id = {$id}";
//$sql = "insert into (`id`,`Mutant region`,`VWD type`,`Mutation type`,`Inheritance`,`Location`,`Nucleotide change`,`Amino acid exchange`,`References`,`Comments`,) mutation values($id, '$Mutant_region', '$VWD_type', '$mutation_type', '$Inheritance', '$Location', '$Nucleotide_change', '$Amino_acid_change', '$References', '$Comments')";

my_error($con, $sql);

header('Refresh:0.5; url=./search.php');
echo "<script>alert('病人数据修改成功')</script>";
exit();

//my_error();

