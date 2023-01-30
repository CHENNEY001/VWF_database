<?php
ini_set("display_errors", 0);

// 数据库初始认证
header('Content-type:text/html;charset=utf-8');

// 设置字符集
function my_error($con, $sql){
    $result = mysqli_query($con, $sql);

    if(!$result){
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    return mysqli_fetch_array($result);
}
// 选择数据库
