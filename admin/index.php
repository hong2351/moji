<?php
require_once 'DBHelper.php';
include '../Substring.php';
session_start();
if (!isset($_SESSION['admin_info'])) {
    echo "<script>window.location.href = 'login.php';</script>";
} else {
    $username = $_SESSION['admin_info']['username'];
}
$switch = isset($_GET['switch']) ? trim($_GET['switch']) : 1;

$page_size = 5;

if (!isset($helper))
    $helper = DBHelper::get_Link();
$sql = "select count(*) from diary";
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
$sql = "select * from diary order by date asc limit $limit, $page_size";
$res = $helper->query($sql);
//var_dump($res);
$diaries = array();
while ($row = mysqli_fetch_assoc($res)) {
    $diaries[] = $row;
}

$sql = "select count(*) from user";
//var_dump($sql . "\n");
$res = $helper->query($sql);
$count_user = mysqli_fetch_row($res);
$count_user = $count_user[0];
//var_dump($count . "\n");
$max_page_user = ceil($count_user / $page_size);
//var_dump($max_page . "\n");
$page_user = isset($_GET['upage']) ? trim($_GET['upage']) : 1;
$page_user = $page_user > $page_user ? $max_page_user : $page_user;
$page_user = $page_user < 1 ? 1 : $page_user;
//var_dump($page . "\n");
$limit_user = ($page_user - 1) * $page_size;
//var_dump($limit . "\n");
$sql = "select * from user order by uid asc limit $limit_user, $page_size";
$res = $helper->query($sql);
//var_dump($res);
$users = array();
while ($row = mysqli_fetch_assoc($res)) {
    $users[] = $row;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>墨记</title>
    <link rel="stylesheet" type="text/css" href="../css/amazeui.min.css"/>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/amazeui.min.js"></script>
    <style type="text/css">
        #main-area {
            width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            padding-left: 15px;
            font-size: 25px;
        }

        table {
            padding-bottom: 0px;
        }

        tr, th {
            text-align: center;
        }

        .title {
            height: 60px;
        }

        #user {
            padding-top: 10px;
            padding-right: 15px;
        }

        .title-bar {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div id="main-area">
    <div class="title">
        <span class="am-fl">
            <h2 class="title-bar">墨记管理</h2>
        </span>
        <div id="user" class="am-fr">
            <span class="am-sans-serif">
                <?php echo $username ?>
            </span>
            &nbsp;&nbsp;
            <span>
                <button type="button" id="btn-cancel" class="am-btn am-btn-danger am-btn-xs">注销</button>
            </span>
        </div>
    </div>
    <div class="am-panel am-panel-default">
        <header class="am-panel-hd">
            <div>管理页面删除数据将无法恢复，删除前请谨慎</div>
        </header>
        <div data-am-widget="tabs" class="am-tabs am-tabs-default">
            <ul class="am-tabs-nav am-cf">
                <li class="<?php if ($switch == 1) echo ' am-active'; ?>"><a href="[data-tab-panel-0]">文章</a></li>
                <li class="<?php if ($switch == 2) echo ' am-active'; ?>"><a href="[data-tab-panel-1]">用户</a></li>
            </ul>
            <div class="am-tabs-bd">
                <div data-tab-panel-0 class="am-tab-panel<?php if ($switch == 1) echo ' am-active'; ?>">
                    <table class="am-table am-table-bordered">
                        <thead>
                        <tr>
                            <th>日期</th>
                            <th data-am-popover="{content: '点击梗概查看全文', trigger: 'hover focus'}">文章梗概</th>
                            <th>用户</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($diaries)) { ?>
                            <?php foreach ($diaries as $diary) { ?>
                                <tr>
                                    <td><?php echo $diary['date'] ?></td>
                                    <td>
                                        <a href="javascript:void(0);"
                                           onclick="showPopup(<?php echo $diary['did'] ?>)">
                                            <?php
                                            $content = trim(strip_tags($diary['text']));
                                            if (strlen($content) > 50) {
                                                echo cubstr($content, 0, 50) . "&nbsp;&nbsp;...";
                                            } else {
                                                echo $content;
                                            }
                                            ?>
                                        </a>
                                    </td>
                                    <td><?php echo $diary['username'] ?></td>
                                    <td>
                                        <button type="button" class="am-btn am-btn-danger am-btn-xs"
                                                onclick="delete_article(<?php echo $diary['did'] ?>)">删除
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php if ($count != 0): ?>
                        <ul class="am-pagination am-pagination-centered">
                            <?php if ($page != 1): ?>
                                <li>
                                    <a href="<?php echo './index.php?' . 'page=' . (($page - 1) > 0 ? ($page - 1) : 1) . '&upage=' . $page_user . '&switch=1'; ?>">&laquo;</a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $max_page; $i++) { ?>
                                <li <?php if ($i == $page) echo 'class="am-active"' ?>>
                                    <a href="<?php echo './index.php?' . 'page=' . $i . '&upage=' . $page_user . '&switch=1'; ?>"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($page != $max_page): ?>
                                <li>
                                    <a href="<?php echo './index.php?' . 'page=' . (($page + 1) < $max_page ? ($page + 1) : $max_page) . '&upage=' . $page_user . '&switch=1'; ?>">&raquo;</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div data-tab-panel-1 class="am-tab-panel<?php if ($switch == 2) echo ' am-active'; ?>">
                    <table class="am-table am-table-bordered">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>密码</th>
                            <th>昵称</th>
                            <th>生日</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($users)) { ?>
                            <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?php echo $user['username'] ?></td>
                                    <td><?php echo $user['password'] ?></td>
                                    <td><?php echo $user['nickname'] ?></td>
                                    <td><?php echo $user['birthday'] ?></td>
                                    <td>
                                        <button type="button" class="am-btn am-btn-danger am-btn-xs"
                                                onclick="delete_user(<?php echo $user['uid'] ?>)">删除
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php if ($count_user != 0): ?>
                        <ul class="am-pagination am-pagination-centered">
                            <?php if ($page_user != 1): ?>
                                <li>
                                    <a href="<?php echo './index.php?page=' . $page . '&upage=' . (($page_user - 1) > 0 ? ($page_user - 1) : 1) . '&switch=2'; ?>">&laquo;</a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $max_page_user; $i++) { ?>
                                <li <?php if ($i == $page_user) echo 'class="am-active"' ?>>
                                    <a href="<?php echo './index.php?page=' . $page . '&upage=' . $i . '&switch=2'; ?>"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <?php if ($page_user != $max_page_user): ?>
                                <li>
                                    <a href="<?php echo './index.php?page=' . $page . '&upage=' . (($page_user + 1) < $max_page_user ? ($page_user + 1) : $max_page_user) . '&switch=2'; ?>">&raquo;</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($diaries)) { ?>
        <?php foreach ($diaries as $diary) { ?>
            <div class="am-popup" id="my-popup<?php echo $diary['did'] ?>">
                <div class="am-popup-inner">
                    <div class="am-popup-hd">
                        <h4 class="am-popup-title"><?php echo $diary['date'] ?></h4>
                        <span data-am-modal-close class="am-close">&times;</span>
                    </div>
                    <div class="am-popup-bd">'<?php echo $diary['text'] ?></div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if (!empty($error)): ?>
        <div class="am-panel am-panel-warning" id="error-panel">
            <div class="am-panel-hd"><b>提示</b></div>
            <div class="am-panel-bd">
                <ul>
                    <?php foreach ($error as $item) echo "<li>$item</li>" ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
<script type="text/javascript">
    $(function () {
        setTimeout(function () {
            $('#error-panel').css('display', 'none');
        }, 1500);
    })

    function showPopup(id) {
        $('#my-popup' + id).modal('open');
    }

    function delete_article(id) {
        window.location = "delete.php?id=" + id + "&type=1";
    }

    function delete_user(id) {
        window.location = "delete.php?id=" + id + "&type=2";
    }

    $(function () {
        $('#datepicker_area').datepicker().on('changeDate.datepicker.amui', function (event) {
            var d = event.date;
            window.location = "index.php?year=" + d.getFullYear() + "&month=" + (d.getMonth() + 1);
        });
    });

    $('.title-bar').click(function () {
        window.location = 'index.php';
    })

    $('#btn-cancel').click(function () {
        window.location = "cancel.php";
    })
</script>
</html>
