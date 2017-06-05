<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>墨记</title>
    <link rel="stylesheet" type="text/css" href="css/amazeui.min.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/amazeui.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <style type="text/css">
        body {
            background: #ffffff
        }

        .main_frame {
            width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .title {
            padding-top: 10px;
        }

        .forget-pass {
            float: right;
        }

        #register-form {
            display: none;
        }
    </style>
</head>
<body>
<div class="main_frame">
    <form method="post" action="login.php" class="am-form" id="login-form">
        <div class="am-form-group title">
            <h1>墨记</h1>
        </div>
        <div class="am-form-group">
            <input placeholder="用户名" type="text" name="username">
        </div>
        <div class="am-form-group">
            <input placeholder="密　码" type="password" name="password" class="doc-ipt-pwd-1">
        </div>
        <div class="am-form-group">
            <button type="submit" class="am-btn am-btn-primary">确认</button>
            <button type="button" id="btn-register" class="am-btn am-btn-success">注册</button>
            <button type="button" id="forget-pass" class="am-btn am-btn-danger forget-pass">忘记密码</button>
        </div>
    </form>
    <form method="post" action="login.php" class="am-form" id="register-form" onsubmit="return registerCheck()">
        <div class="am-form-group title">
            <h1>墨记</h1>
        </div>
        <div class="am-form-group">
            <input placeholder="用户名" type="text" name="username" id="register-username">
        </div>
        <div class="am-form-group">
            <input placeholder="密　码" type="password" name="password" class="doc-ipt-pwd-1" id="register-password">
        </div>
        <div class="am-form-group">
            <input placeholder="昵　称" type="text" name="nickname" id="register-nickname">
        </div>
        <div class="am-form-group">
            <label class="am-radio-inline">
                <input type="radio" checked="checked" name="radio" value="male" data-am-ucheck> 男
            </label>
            <label class="am-radio-inline">
                <input type="radio" name="radio" value="female" data-am-ucheck> 女
            </label>
        </div>
        <div class="am-form-group">
            <div class="am-input-group am-datepicker-date" data-am-datepicker="{format: 'yyyy-mm-dd'}">
                <input type="text" class="am-form-field" placeholder="生　日" readonly>
                <span class="am-input-group-btn am-datepicker-add-on">
                    <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
                </span>
            </div>
        </div>
        <div class="am-form-group">
            <button type="submit" class="am-btn am-btn-primary">确认</button>
            <button type="button" id="btn-back" class="am-btn am-btn-success">返回</button>
        </div>
    </form>
    <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">Surprise!</div>
            <div class="am-modal-bd">
                哈哈！我们没有这个功能！惊不惊喜！开不开心！
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">OK</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>