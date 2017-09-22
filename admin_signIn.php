<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css">
    <script src="//cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台登录</title>
</head>
<body class="mdui-theme-layout-dark">
<?php
function getPassword($uid) {
    $conn = new mysqli("localhost", "janyo_admin", "janyo_iloveu", "janyo_manager");
    if (!$conn) {
        return null;
    }

    $fetch = $conn->query("select uid,password from admins where uid=\"$uid\"");
    $result = $fetch->fetch_row();
    if (!result) {
        return null;
    }
    $conn->close();
    // Security check
    if ($uid != $result[0]) {
        return null;
    }

    return $result[1];
}

function tryConnectAndCheck($uid, $password) {
    $toCheck = getPassword($uid);
    $pass = md5($password);
    return $toCheck && $toCheck == $pass;
}

function generateSecretKey($uid, $password) {
    // create-time @ user @ password
    return base64_encode(time() . "@" . $uid . "@" . md5($password));
}

if (isset($_POST["un"]) && isset($_POST["up"])) {
    $uid = $_POST["un"];
    $passWd = $_POST["up"];
    if (!empty($uid) && !empty($passWd)) {
        if (tryConnectAndCheck($uid, $passWd)) {
            // 3 days
            setcookie("secret_key",
                generateSecretKey($uid, $passWd),
                time() + 3600 * 72);
            print("<script language='javascript'>window.location.href='manager.php'</script>");
        } else {
            print("<script language='javascript'>alert('登录失败');</script>");
        }
    }
}
?>
<script language="javascript">
    function doLogin() {
        var un = f.un.value;
        var up = f.up.value;
        if (un.length === 0) {
            alert("用户名不能为空!");
        } else if(up.length === 0) {
            alert("密码不能为空!");
        }
    }
</script>
<div>
    <!--登录卡片-->
    <div class="mdui-card">
        <div class="mdui-card-primary">
            <div class="mdui-card-primary-title">登录</div>
        </div>
        <div class="mdui-card-content">
            <form name="f" method="post">
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">用户名</label>
                    <input name="un" class="mdui-textfield-input" type="text"/>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">密码</label>
                    <input name="up" class="mdui-textfield-input" type="password"/>
                </div>
                <div class="mdui-card-actions">
                    <button onclick="doLogin();" class="mdui-btn mdui-ripple">登陆</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
