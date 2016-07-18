<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>注册</title>
    <script type="text/javascript">
    function check()
    {
        if(document.getElementById('userName').value.length > 16) {
            alert("用户名字数超过16");
            document.getElementById('userName').focus();
            return false;
        }
        
        if(document.getElementById('userPW').value.length < 8) {
            alert("密码长度少于8位")
        }

        if(document.getElementById('userPW').value != document.getElementById('userPW_check').value) {
            alert("两次密码不一致");
            return false;
        }
        return true;
    }
    </script>
</head>
<body>
<div align="center">
<h2 style="font-family:微软雅黑">注册</h2>
<form method="POST" action="register_deal.php" onsubmit="return check()">
    <span style="font-size:1px">(后加*为必填)</span>
    <br/><br/>
    &nbsp用户名：<input type="text" id="userName" name="userName" required>*
    <br/><br/>
    &nbsp&nbsp密码：<input type="password" id="userPW" name="userPW" placeholder="不低于8位" required>*
    <br/><br/>
    确认密码：<input type="password" id="userPW_check" required>*
    <hr width="60%" size="2" />
    姓名：<input type="text" name="Name" required>*
    <br/><br/>
    性别：
    <input type="radio" name="sex" checked="checked">男
    <input type="radio" name="sex">女
    <br/><br/>
    学校：<input type="text" name="School">
    <br/><br/>
    学院：<input type="text" name="Academy">
    <br/><br/>
    专业：<input type="text" name="Major">
    <br/><br/>
    手机：<input type="text" name="Mobile">
    <br/><br/>
    邮箱：<input type="text" name="Email">
    <hr width="60%" size="2" />
    验证码：
    <input type="text" name="passcode" ><img title="点击刷新" src="captcha.php" onclick="this.src='captcha.php?'+Math.random();">
    <br/><br/>
    <input type="reset" name="重置">
    <input type="submit" id="submit" value="提交">
</form>
</div>
</body>
</html>