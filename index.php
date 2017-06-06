<?php
date_default_timezone_set("PRC");
require 'DBHelper.php';
session_start();
if (!isset($_SESSION['user_info'])) {
    echo "<script>window.location.href = 'user.php';</script>";
}
$username = $_SESSION['user_info']['username'];
$nickname = $_SESSION['user_info']['nickname'];
$year = $month = null;
$date_arry = getdate(time());

$year = isset($_GET['year']) ? trim($_GET['year']) : $date_arry['year'];
$month = isset($_GET['month']) ? trim($_GET['month']) : $date_arry['mon'];

//var_dump($year) . var_dump($month);
$s_month = $month < 10 ? "0" . $month : $month;
//var_dump($s_month);
$page_size = 5;

$helper = DBHelper::get_Link();
$sql = "select count(*) from diary where username = '$username' and year='$year' and month='$month'";
//var_dump($sql . "\n");
$res = $helper->query($sql);
$count = mysqli_fetch_row($res);
$count = $count[0];
//var_dump($count . "\n");
$max_page = ceil($count / $page_size);
//var_dump($max_page . "\n");
$page = isset($_GET['page']) ? trim($_GET['page']) : 1;
$page = $page > $max_page ? $max_page : $page;
$page = $page < 1 ? 1 : $page;
//var_dump($page . "\n");
$limit = ($page - 1) * $page_size;
//var_dump($limit . "\n");
$sql = "select * from diary where username = '$username'and year = '$year'and month = '$month'  order by date asc limit $limit, $page_size";
$res = $helper->query($sql);
//var_dump($res);
$diaries = array();
while ($row = mysqli_fetch_assoc($res)) {
    $diaries[] = $row;
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>墨记</title>
    <link rel="stylesheet" type="text/css" href="css/amazeui.min.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/amazeui.min.js"></script>
    <style type="text/css">
        p {
            margin: 0px;
        }

        h2 {
            padding-left: 15px;
            font-size: 25px;
        }

        #user {
            padding-top: 10px;
            padding-right: 15px;
        }

        .am-panel-title {
            height: 38px;
            line-height: 38px;
            text-align:;
        }

        .am-breadcrumb {
            padding-top: 0px;
            padding-bottom: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        #main-area {
            width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .title-bar{
            cursor: pointer;
        }

        .title {
            height: 60px;
        }

        .diary-artical {
            margin: 15px;
            cursor: hand;
        }

        .article-title:hover {
            cursor: pointer;
            color: #ffffff;
            background-color: rgba(243, 123, 29, 0.65);
            border-color: rgba(243, 123, 29, 0.65);
        }
    </style>
</head>
<body>
<div id="main-area">
    <div class="title">
        <span class="am-fl">
            <h2 class="title-bar">墨记</h2>
        </span>
        <div id="user" class="am-fr">
            <span class="am-sans-serif">
                <?php echo $nickname ?>
            </span>
            &nbsp;&nbsp;
            <span>
                <button type="button" id="btn-cancel" class="am-btn am-btn-danger am-btn-xs">注销</button>
            </span>
        </div>
    </div>
    <div class="am-panel am-panel-default">
        <header class="am-panel-hd">
            <h3 class="am-panel-title">
                <span class="am-breadcrumb">
                    <li><a href="#" class="am-icon-home">个人日记</a></li>
                </span>
                <button type="button" id="btn-edit" class="am-fr am-btn am-btn-success am-btn-m">写日记</button>
            </h3>
        </header>
        <div id="datepicker_area" class="am-panel-bd">
            <div class="am-input-group am-datepicker-date"
                 data-am-datepicker="{format: 'yyyy-mm', viewMode: 'months', minViewMode: 'months'}">
                <input id="date-picker" type="text" class="am-form-field"
                       data-am-popover="{content: '选择日期', trigger: 'hover focus'}"
                       placeholder="<?php echo $year . '-' . $s_month ?>" readonly>
                <span class="am-input-group-btn am-datepicker-add-on">
                <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span></button>
                </span>
            </div>
        </div>
        <?php if (!empty($diaries)) { ?>
            <?php foreach ($diaries as $diary) { ?>
                <div class="am-panel am-panel-warning diary-artical">
                    <div class="am-panel-hd article-title"><?php echo $diary['date'] ?></div>
                    <div class="am-panel-bd">
                        <?php
                        $content = strip_tags($diary['text']);
                        if (strlen($content) > 270) {
                            echo mb_substr($content, 0, 270) . "&nbsp;&nbsp;...";
                        } else {
                            echo $content;
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if ($count != 0): ?>
            <ul class="am-pagination am-pagination-centered">
                <?php if ($page != 1): ?>
                    <li>
                        <a href="<?php echo './index.php?year=' . $year . '&month=' . $month . '&page=' . (($page - 1) > 0 ? ($page - 1) : 1); ?>">&laquo;</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $max_page; $i++) { ?>
                    <li <?php if ($i == $page) echo 'class="am-active"' ?>>
                        <a href="<?php echo './index.php?year=' . $year . '&month=' . $month . '&page=' . $i ?>"><?php echo $i ?></a>
                    </li>
                <?php } ?>
                <?php if ($page != $max_page): ?>
                    <li>
                        <a href="<?php echo './index.php?year=' . $year . '&month=' . $month . '&page=' . (($page + 1) < $max_page ? ($page + 1) : $max_page) ?>">&raquo;</a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
</body>
<script type="text/javascript">
    var date = new Date();
    var month = date.getMonth();
    if (month < 9)
        month = "0" + (month + 1);
    var day = date.getMonth();
    if (day < 9)
        day = "0" + (day + 1);
    var s_date = date.getFullYear() + "-" + month + "-" + day;

    $(function () {
        $('#datepicker_area').datepicker().on('changeDate.datepicker.amui', function (event) {
            var d = event.date;
            window.location = "index.php?year=" + d.getFullYear() + "&month=" + (d.getMonth() + 1);
        });
    });

    $('.title-bar').click(function () {
        window.location = 'index.php';
    })

    $('.article-title').click(function () {
        var temp = $(this).text();
        window.location = "edit.php?date=" + temp.trim();
    })

    $('#btn-cancel').click(function () {
        window.location = "cancel.php";
    })

    $('#btn-edit').click(function () {
        window.location = "edit.php?date=" + s_date;
    })
</script>
</html>