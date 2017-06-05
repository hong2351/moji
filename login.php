<?php
require 'DBHelper.php';
if (!empty($_POST)) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
}
$helper = DBHelper::get_Link();
$sql = "select password from user where username = '" . $username . "'";
$res = $helper->query($sql);
if (!$res) {
    die("sql error" . $helper->link->error);
} else {
    $row = $res->fetch_object();
    if ($row->password == $password) {
        session_start();
        $_SESSION['user_info'] = array(
            'username' => $username
        );
        echo "<script>window.location.href = 'http://localhost/moji/show.php';</script>";
    } else {
        $error[] = "密码错误";
    }
}