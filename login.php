<?php
require 'DBHelper.php';
if (!empty($_POST)) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
}
$helper = DBHelper::get_Link();
$sql = "select * from user where username = '" . $username . "'";
$res = $helper->query($sql);
if ($res->num_rows == 0) {
    $error[] = "用户不存在";
} else {
    $row = $res->fetch_object();
    if ($row->password == $password) {
        session_start();
        $_SESSION['user_info'] = array(
            'username' => $username,
            'nickname' => $row->nickname
        );
        echo "<script>window.location.href = 'http://localhost/moji/index.php';</script>";
    } else {
        $error[] = "密码错误";
    }
}
require 'user.php';