/**
 * Created by lanyuanxiaoyao on 2017/6/5.
 */

// 注册按钮点击事件
$("#btn-register").click(function () {
    $("#login-form").css("display", "none");
    $("#register-form").css("display", "block");
});

// 返回按钮点击事件
$("#btn-back").click(function () {
    $("#login-form").css("display", "block");
    $("#register-form").css("display", "none");
})

// 忘记密码按钮点击事件
$("#forget-pass").click(function () {
    $('#my-alert').modal('toggle');
})

// 注册登录校验
function registerCheck() {
    var r_username = $("#register-username");
    var r_password = $("#register-password");
    if(r_username.val().length < 3){
        r_username.popover({
            content: '用户名至少有3个字符',
            trigger: 'focus',
            theme: 'danger sm'
        });
        r_username.popover('open');
        r_username.focus();
        return false;
    }
    return true;
}