<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>墨记</title>
    <link rel="stylesheet" type="text/css" href="css/amazeui.min.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/amazeui.min.js"></script>
    <style type="text/css">
        body {
            background: #ffffff
        }

        ul {
            margin-bottom: 0px;
        }

        .main_frame {
            width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .title {
            padding-top: 10px;
        }

        <?php
            if (isset($is_login)){
                if (!$is_login){
                    echo '#login-form{ display: none }';
                }else{
                    echo '#register-form{ display: none }';
                }
            }else{
                echo '#register-form{ display: none }';
            }
        ?>

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
            <button type="button" id="forget-pass" class="am-btn am-btn-danger forget-pass am-fr">忘记密码</button>
        </div>
    </form>

    <form method="post" action="register.php" class="am-form" id="register-form">
        <div class="am-form-group title">
            <h1>墨记</h1>
        </div>
        <div class="am-form-group">
            <input placeholder="用户名" type="text" name="username" id="register-username" required maxlength="10"
                   minlength="5">
        </div>
        <div class="am-form-group">
            <input placeholder="密　码" type="password" name="password" class="doc-ipt-pwd-1" id="register-password"
                   required maxlength="10" minlength="5">
        </div>
        <div class="am-form-group">
            <input placeholder="昵　称" type="text" name="nickname" id="register-nickname" required maxlength="5"
                   minlength="2">
        </div>
        <div class="am-form-group">
            <label class="am-radio-inline">
                <input type="radio" checked="checked" name="sex" value="male" data-am-ucheck> 男
            </label>
            <label class="am-radio-inline">
                <input type="radio" name="sex" value="female" data-am-ucheck> 女
            </label>
        </div>
        <div class="am-form-group">
            <div class="am-input-group am-datepicker-date" data-am-datepicker="{format: 'yyyy-mm-dd'}">
                <input type="text" class="am-form-field" placeholder="生　日" readonly required name="birthday">
                <span class="am-input-group-btn am-datepicker-add-on">
                    <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
                </span>
            </div>
        </div>
        <div class="am-form-group">
            <button type="submit" class="am-btn am-btn-primary">注册</button>
            <button type="button" id="btn-back" class="am-btn am-btn-success">返回</button>
        </div>
    </form>
    <?php if (!empty($error)): ?>
        <div class="am-panel am-panel-danger" id="error-panel">
            <div class="am-panel-hd"><b>错误</b></div>
            <div class="am-panel-bd">
                <ul>
                    <?php foreach ($error as $item) echo "<li>$item</li>" ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
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
<script type="text/javascript">

    // 错误提示
    $(function () {
        $('#register-form').validator({
            onValid: function (validity) {
                $(validity.field).closest('.am-form-group').find('.am-alert').hide();
            },
            onInValid: function (validity) {
                var $field = $(validity.field);
                var $group = $field.closest('.am-form-group');
                var $alert = $group.find('.am-alert');
                // 使用自定义的提示信息 或 插件内置的提示信息
                var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

                if (!$alert.length) {
                    $alert = $('<div class="am-alert am-alert-danger"></div>').hide().appendTo($group);
                }

                $alert.html(msg).show();
            }
        });
    });

    // 注册按钮点击事件
    $("#btn-register").click(function () {
        $("#login-form").css("display", "none");
        $("#register-form").css("display", "block");
        $("#error-panel").css("display", "none");
    });

    // 返回按钮点击事件
    $("#btn-back").click(function () {
        $("#login-form").css("display", "block");
        $("#register-form").css("display", "none");
        $("#error-panel").css("display", "none");
    })

    // 忘记密码按钮点击事件
    $("#forget-pass").click(function () {
        $('#my-alert').modal('toggle');
    })
</script>
</html>