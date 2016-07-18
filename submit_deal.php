<?php
require_once('include.php');
session_start();
$config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>pagewrong</title>
</head>
<body>

<?php
//处理留言
$message = deal_input($_POST['text']);
$sub = deal_input($_POST['sub']);

$db = new c_mysqli();
$db->connectMysql('MessageBoard',$config);

$name=$_SESSION["userName"];
$time=time();

$arr = array(
    'Name' => $name,
    'Subject' => $sub,
    'Message' => $message,
    'Time' => $time
    );

$db->insertData('Message', $arr);

header("Location:index.php");
?>
</body>
</html>