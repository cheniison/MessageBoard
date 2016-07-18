<?php
require_once('include.php');
session_start();
$config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );

if($_SESSION['code']!=$_POST['passcode']) {
    echo "验证码不正确！<a href='selfInfo_modify.php?name=" . $_POST['userName'] . "'>返回</a>";
    die();
}

$db = new c_mysqli();
$db->connectMysql('MessageBoard', $config);

$name = $_POST['Name'];
$sex = ($_POST['Sex']=='男'?1:0);
$school = $_POST['School'];
$academy = $_POST['Academy'];
$major = $_POST['Major'];
$mobile = $_POST['Mobile'];
$email = $_POST['Email'];

$arr = array(
    'Name' => $name,
    'Sex' => $sex,
    'School' => $school,
    'Academy' => $academy,
    'Major' => $major,
    'Mobile' => $mobile,
    'Email' => $email
    );
$where = "userName='" . $_POST['userName'] . "'";
$db->updateData('UserInfo',$arr,$where);
echo "修改成功！";
echo "<a href='selfInfo.php?name=".$_POST['userName']."'>返回</a>"
