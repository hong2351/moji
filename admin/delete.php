<?php
require_once 'DBHelper.php';
if (!empty($_GET)) {
    // 获取用户名和密码
    $id = isset($_GET['id']) ? trim($_GET['id']) : '';
    $type = isset($_GET['type']) ? trim($_GET['type']) : '';
}
// 获取数据库连接
$helper = DBHelper::get_Link();
// 构造sql语句
if($type == 1)
    $sql = "delete from diary where did ='$id'";
elseif($type == 2)
    $sql = "delete from user where uid ='$id'";
// 获取查询结果集
$res = $helper->query($sql);
if (!$res) {
    $error[] = "删除失败";
} else {
    $error[] = "删除成功";
}
require 'index.php';