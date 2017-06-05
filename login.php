<?php
if (!empty($_POST)) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
}
$mysql_conf = array(
    'host' => '127.0.0.1:3306',
    'db' => 'moji_db',
    'db_user' => 'root',
    'db_pwd' => 'root'
);
$mysqli = @new mysqli($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
if ($mysqli->connect_error) {
    die("could not connect to the database:\n" . $mysqli->connect_error);
}
$mysqli->query("set names 'utf8';");
$select_db = $mysqli->select_db($mysql_conf['db']);
$sql = "select password from user where username = '" . $username . "'";
$res = $mysqli->query($sql);
if (!$res) {
    die("sql error:\n" . $mysqli->error);
}else{
    $row = $res->fetch_object();
    if ($row->password == $password){
        echo 'success';
    }
}
$res->free();
$mysqli->close();