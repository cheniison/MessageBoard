<?php
require_once('include.php');
$config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );

$db = new c_mysqli();
$db->connectMysql('MessageBoard', $config);
$db->delData('Message',"`id` = " . $_GET['id']);

mysqli_close($con); 
header("Location:" . $_GET['from']);
