<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>墨记</title>
    <link rel="stylesheet" type="text/css" href="css/amazeui.min.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/amazeui.min.js"></script>
    <style type="text/css">
        .main-area {
            padding-top: 200px;
            width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .am-panel-hd {
            font-size: 25px;
        }
    </style>
</head>
<body>
<div class="main-area">
    <div class="am-panel am-panel-success">
        <div class="am-panel-hd">成功</div>
        <div class="am-panel-bd">
            文章保存成功，页面将在&nbsp;<b><span class="second">3</span></b>&nbsp;秒后自动跳转到主界面
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    var time = 2;

    $(function () {
        setInterval(function () {
            if (time > 0)
                $('.second').text(time--);
            else
                window.location = "<?php echo $page ?>"
        }, 1000);
    })
</script>
</html>