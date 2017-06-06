<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>墨记</title>
    <link rel="stylesheet" type="text/css" href="../css/amazeui.min.css"/>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/amazeui.min.js"></script>
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

        .title-bar {
            cursor: pointer;
        }

    </style>
</head>
<body>
<div class="main_frame">
    <form method="post" action="login_check.php" class="am-form" id="login-form">
        <div class="am-form-group title">
            <h1 class="title-bar">墨记管理</h1>
        </div>
        <div class="am-form-group">
            <input placeholder="用户名" type="text" name="username" required>
        </div>
        <div class="am-form-group">
            <input placeholder="密　码" type="password" name="password" class="doc-ipt-pwd-1" required>
        </div>
        <div class="am-form-group">
            <button type="submit" id="btn-login" class="am-btn am-btn-primary am-btn-block">登录</button>
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
</div>
</body>
<script type="text/javascript">

    // 错误提示
    $('#login-form').validator({
        onValid: function (validity) {
            $(validity.field).closest('.am-form-group').find('.am-alert').hide();
        },
        onInValid: function (validity) {
            var $field = $(validity.field);
            var $group = $field.closest('.am-form-group');
            var $alert = $group.find('.am-alert');
            var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

            if (!$alert.length) {
                $alert = $('<div class="am-alert am-alert-danger"></div>').hide().appendTo($group);
            }

            $alert.html(msg).show();
        }
    });
    })
    ;

    $('.title-bar').click(function () {
        window.location = 'index.php';
    })

</script>
</html>