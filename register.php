<?php
require 'DBHelper.php';
if (!empty($_POST)) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
    $sex = isset($_POST['sex']) ? trim($_POST['sex']) : '';
    $birthday = isset($_POST['birthday']) ? trim($_POST['birthday']) : '';
}
$helper = DBHelper::get_Link();
$sql = "select * from user where username = '" . $username . "'";
$res = $helper->query($sql);
if (!$res) {
    die("sql error" . $helper->link->error);
} else {
    if ($res->num_rows >= 1) {
        $error[] = '用户名已存在';
        $is_login = false;
        require 'user.php';
    } else {
        $real_sex = $sex == 'male' ? 1 : 0;
        $sql_insert = "insert into user values('','$username','$password','$nickname','$real_sex','$birthday')";
        $res = $helper->query($sql_insert);
        if (!$res) {
            die("sql error" . $helper->link->error);
        } else {
            require 'success.php';
        }
    }
}