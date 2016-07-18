<?php
    require_once('include.php');
    session_start();
    $config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );

    if($_SESSION['code']!=$_POST['passcode']) {
        echo "验证码不正确！<a href='register.php'>返回</a>";
        die();
    }

    $db = new c_mysqli();
    $db->connectMysql('MessageBoard', $config);

    $username = $_POST['userName'];
    $password = md5($_POST['userPW']);
    $name = $_POST['Name'];
    $sex = ($_POST['Sex']=='男'?1:0);
    $school = $_POST['School'];
    $academy = $_POST['Academy'];
    $major = $_POST['Major'];
    $mobile = $_POST['Mobile'];
    $email = $_POST['Email'];

    $arr = array(
        'userName' => $username,
        'userPW' => $password,
        'Name' => $name,
        'Sex' => $sex,
        'School' => $school,
        'Academy' => $academy,
        'Major' => $major,
        'Mobile' => $mobile,
        'Email' => $email
        );

    if(mysqli_fetch_array($db->mkQuery("SELECT * FROM UserInfo WHERE userName='$name'"))) {
        echo "用户名已被注册！<a href='register.php'>返回</a>";
    } elseif($db->insertData('UserInfo', $arr)) {
        echo "注册成功！<a href='login.php'>返回</a>";
    } else {
        die("注册失败！".mysqli_error($con));
    }
    $db->closeConnection();
?>