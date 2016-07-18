<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <script type="text/javascript">
        function check()
        {
            if(document.getElementById('userName').value.length>15) {
                alert("用户名字数超过15");
                document.getElementById('userName').focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<?php
//打开session
session_start(); 
// if(isset($_SESSION['userName']))
// {
//  header("Location:index.php");
// }
?>
<div align="center">
    <h2 style="font-family:微软雅黑">登录</h2>
    <form method="post" action="login_deal.php" onsubmit="return check()">
        <label for="userName">用户名：</label><input type="text" name="userName" id="userName" value="<?php echo isset($_SESSION['userName'])?$_SESSION['userName']:'';?>" required/>
        <!-- required：此项必填 -->
        <br/><br/>
        <label for="userPW">&nbsp密码：</label><input type="password" name="userPW" id="userPW" value="<?php echo  isset($_SESSION['userPW'])?$_SESSION['userPW']:'';?>" required/>
        <br/><br/>
        验证码：<input type="text" name="passcode" >
        <img title="点击刷新" src="captcha.php" onclick="this.src='captcha.php?'+Math.random();">
        <br/><br/>
        <?php if(isset($_SESSION['isremember'])){?><input type="checkbox" name="remember" checked><?php }else{?><input type="checkbox" name="remember" ><?php }?>记住用户名和密码
        <!-- checkbox的checked不管赋什么值(包括"false")都默认为打开，不写checked则是关闭 -->
        <!-- <br/><br/> -->&nbsp
        <input type="submit" name="Submit" value="登录" />
        <a href="register.php">注册</a>
    </form>
</div>
</body>
</html>