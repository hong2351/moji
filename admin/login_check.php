<?php
require 'DBHelper.php';
if (!empty($_POST)) {
    // 获取用户名和密码
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
}
// 获取数据库连接
$helper = DBHelper::get_Link();
// 构造sql语句
$sql = "select * from admin where username = '" . $username . "'";
// 获取查询结果集
$res = $helper->query($sql);
if ($res->num_rows == 0) {
    $error[] = "用户不存在";
} else {
    $row = $res->fetch_object();
    if ($row->password == $password) {
        session_start();
        $_SESSION['admin_info'] = array(
            'username' => $username
        );
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        $error[] = "密码错误";
    }
}
require 'login.php';