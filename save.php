<?php
require 'DBHelper.php';
if (!empty($_POST)) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $year = isset($_POST['year']) ? trim($_POST['year']) : '';
    $month = isset($_POST['month']) ? trim($_POST['month']) : '';
    $day = isset($_POST['day']) ? trim($_POST['day']) : '';
    $date = isset($_POST['date']) ? trim($_POST['date']) : '';
    $page = isset($_POST['page']) ? trim($_POST['page']) : '';
}
$helper = DBHelper::get_Link();
$sql = "select * from diary where date = '" . $date . "'";
$res = $helper->query($sql);
if (!$res) {
    die("sql error" . $helper->link->error);
} else {
    if ($res->num_rows >= 1) {
        $sql_update = "update diary set username = '$username',text = '$content',year = '$year', month = '$month',day = '$day' where date = '$date'";
        $res = $helper->query($sql_update);
        if (!$res) {
            die("sql error" . $helper->link->error);
        } else {
            require 'save_success.php';
        }
    } else {
        $sql_insert = "insert into diary values('','$username','$content','$year','$month','$day','$date')";
        $res = $helper->query($sql_insert);
        if (!$res) {
            die("sql error" . $helper->link->error);
        } else {
            require 'save_success.php';
        }
    }
}