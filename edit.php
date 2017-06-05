<?php
require 'DBHelper.php';
session_start();
if (!isset($_SESSION['user_info'])) {
    echo "<script>window.location.href = 'http://localhost/moji/user.php';</script>";
} else {
    $username = $_SESSION['user_info']['username'];
    $nickname = $_SESSION['user_info']['nickname'];
}
if (!empty($_GET)) {
    $date = isset($_GET['date']) ? trim($_GET['date']) : '';
}
if ($date != '') {
    $arr = explode('-', $date);
    $year = trim($arr[0]);
    $month = trim($arr[1]);
    $day = trim($arr[2]);
}

$helper = DBHelper::get_Link();
$sql = "select * from diary where username = '$username' date = '$date'";
$res = $helper->query($sql);
if ($res) {
    if ($res->num_rows != 0) {
        $row = $res->fetch_object();
        $content = $row->text;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>墨记</title>
    <link rel="stylesheet" type="text/css" href="css/amazeui.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/simditor.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/amazeui.min.js"></script>
    <script type="text/javascript" src="js/module.min.js"></script>
    <script type="text/javascript" src="js/hotkeys.min.js"></script>
    <script type="text/javascript" src="js/simditor.min.js"></script>
    <style type="text/css">
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

        .title {
            height: 60px;
        }

        .date {
            font-size: 20px;
            padding: 15px;
            text-align: center;
        }

        #time {
            display: none;
        }

        .footer-button button {
            margin-left: 5px;
        }
    </style>
</head>
<body>
<div id="main-area">
    <div class="title">
        <span class="am-fl">
            <h2>墨记</h2>
        </span>
        <div id="user" class="am-fr">
            <span class="am-monospace">
                <?php echo $_SESSION['user_info']['username'] ?>
            </span>
            &nbsp;&nbsp;
            <span>
                <button type="button" id="btn-cancel" class="am-btn am-btn-danger am-btn-xs">注销</button>
            </span>
        </div>
    </div>
    <form action="save.php" method="post" onsubmit="return check()">
        <div class="am-panel am-panel-secondary">
            <header class="am-panel-hd">
                <h3 class="am-panel-title">
                <span class="am-breadcrumb">
                    <li><a href="http://localhost/moji/index.php" class="am-icon-home">个人日记</a></li>
                    <li class="am-active">编辑</li>
                </span>
                </h3>
            </header>
            <div class="date am-monospace">
                <div id="time">
                    <input type="text" name="username" value="<?php echo $username ?>">
                    <input type="text" name="year" value="<?php echo $year ?>">
                    <input type="text" name="month" value="<?php echo $month ?>">
                    <input type="text" name="day" value="<?php echo $day ?>">
                    <input type="text" name="date" value="<?php echo $date ?>">
                </div>
                <span><?php echo $year ?></span>-<span><?php echo $month ?></span>-<span><?php echo $day ?></span>
            </div>
            <textarea id="editor" name="content" placeholder="写下你的心情" autofocus><?php if (isset($content)) echo $content ?></textarea>
        </div>
        <div class="footer-button">
            <button type="submit" id="btn-save" class="am-fr am-btn am-btn-primary am-btn-lg">保存</button>
            <button type="button" id="btn-back" class="am-fr am-btn am-btn-warning am-btn-lg">返回</button>
        </div>
    </form>
    <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd"><b>注意</b></div>
            <div class="am-modal-bd">
                不能保存空文章
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">OK</span>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    var editor = new Simditor({
        textarea: $('#editor'),
        upload: false,
        toolbar: [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'table',
            'link',
            'hr']
    });
    $('#btn-cancel').click(function () {
        window.location = "http://localhost/moji/cancel.php";
    })

    $('#btn-back').click(function () {
        window.history.back();
    })

    function get_date() {
        var array = $('#date').text().split('-');
    }

    function check() {
        var content = editor.getValue();
        if (!content == "") {
            return true;
        } else {
            $('#my-alert').modal('toggle');
        }
        return false;
    }
</script>
</html>