<?php
session_start();
if (!isset($_SESSION['user_info'])) {
    echo "<script>window.location.href = 'http://localhost/moji/user.php';</script>";
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

        .simditor {
            border: none;
        }

        .title {
            height: 60px;
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
    <div class="am-panel am-panel-default">
        <header class="am-panel-hd">
            <h3 class="am-panel-title">
                <span class="am-breadcrumb">
                    <li><a href="#" class="am-icon-home">个人日记</a></li>
                </span>
                <button type="button" id="btn-edit" class="am-fr am-btn am-btn-success am-btn-m">写日记</button>
            </h3>
        </header>
        <div class="am-panel-bd">
            <div class="am-input-group am-datepicker-date"
                 data-am-datepicker="{format: 'yyyy-mm', viewMode: 'years', minViewMode: 'months'}">
                <input type="text" id="date-picker" class="am-form-field" placeholder="选择日期" readonly required
                       name="date">
                <span class="am-input-group-btn am-datepicker-add-on">
                    <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
                </span>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    var date = new Date();
    var month = date.getMonth();
    if (month < 9)
        month = "0" + (month + 1);
    var day = date.getMonth();
    if (day <= 9)
        day = "0" + day;
    var s_date = date.getFullYear() + "-" + month + "-" + day;
    $('#date-picker').datepicker('setValue', s_date);

    $('#btn-cancel').click(function () {
        window.location = "http://localhost/moji/cancel.php";
    })

    $('#btn-edit').click(function () {

        window.location = "http://localhost/moji/edit.php?date=" + s_date;
    })
</script>
</html>