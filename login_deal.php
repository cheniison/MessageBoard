<?php
require_once('include.php');
session_start();
$config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>登录失败</title>
    <?php 
    if($_SESSION['code']!=$_POST['passcode']) {
        echo "验证码不正确！";
        ?>
        <a href="login.php">返回</a>
        <?php
        die();
    }

    $db = new c_mysqli();
    $db->connectMysql('MessageBoard', $config);

    $name=$_POST['userName'];
    $password=md5($_POST['userPW']);


    if(!mysqli_fetch_array($db->mkQuery("SELECT * FROM UserInfo WHERE userName='$name'"))) {
        session_start();
        unset($_SESSION['userName']);
        unset($_SESSION['userPW']);
        unset($_SESSION['isremember']);
        echo "用户名不存在！";
        ?>
        <br/>
        <a href="login.php" name="返回">返回</a>
        <?php
        mysqli_close($con);
        die();
    }

    if(!mysqli_fetch_array($db->mkQuery("SELECT * FROM UserInfo WHERE userName='$name' AND userPW='$password' "))) {
        session_start();
        unset($_SESSION['userName']);
        unset($_SESSION['userPW']);
        unset($_SESSION['isremember']);
        echo "用户名密码错误！";
        ?>
        <br/>
        <a href="login.php" name="返回">返回</a>
        <?php
        mysqli_close($con);
    } else {
        mysqli_close($con);
        
        if(isset($_POST['remember'])) {
            session_set_cookie_params(60*60*24);
            session_start();
            $_SESSION['userName']=$_POST['userName'];
            $_SESSION['userPW']=$_POST['userPW'];
            $_SESSION['isremember']=1;
        } else {
            session_start();
            $_SESSION['userName']=$_POST['userName'];
            $_SESSION['userPW']=$_POST['userPW'];
            unset($_SESSION['isremember']);
        }
        header("Location:index.php");
    }
    ?>
    
    
</head>
<body>

</body>
</html>