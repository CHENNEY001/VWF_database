<script type="text/javascript">
    let id = window.localStorage.getItem("communityId");
    function postToPage(id){
        window.localStorage.setItem("communityId",id);
    }
</script>
<?php
ini_set("display_errors", 0);
//获取提交数据
echo "<script>postToPage(1)</script>";

$username=$_POST['user1'];//获取提交用户名
$password=$_POST['psw1'];//获取提交密码

//连接数据库
$db_host="127.0.0.1";
$db_user="root";
$db_pwd="123456";
$db_name="vwf";

$con=mysqli_connect($db_host,$db_user,$db_pwd,$db_name);//连接数据库，且定位到指定数据库
if(!$con){
    die("error:".mysqli_connect_error());//返回最近调用函数的最后一个错误描述。
} //如果连接失败就报错并且中断程序

if($username==null||$password==null){
    echo "<script>alert('不要乱填啊')</script>";//弹出消息框
    die("账号和密码不能为空!");//结束并返回文本
}//判断用户名和密码是不是空的

$sql1='select * from users where username='."'{$username}'and password="."'$password';";
$res=mysqli_query($con,$sql1);
$row=$res->num_rows; //将获取到的用户名和密码拿到数据库里面去查找匹配
if($row!=0)
{
    echo "<h1>{$username}用户名已存在&nbsp！</h1>";
}
else
{
    $sql2 = "insert into users values('$username', '$password')";
    $result=mysqli_query($con, $sql2);
    if(!$result){
        echo "<script>alert('注册失败')</script>";
    }else{
        echo "<script>alert('注册成功')</script>";
        header('Refresh:0.5; url=../php_for_all/main_search.php');
    }
    @ mysqli_free_result($result);
}

