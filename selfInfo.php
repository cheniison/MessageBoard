<?php
require_once('include.php');
session_start();
$config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>个人信息</title>
</head>
<body>
<?php
if(!isset($_SESSION['userName'])) {
    ?>
    <div style="text-align:right;">
        您好，请先<a href="login.php">登录</a>
    </div>
    <?php
} 
else
{
    ?>
    <div style="text-align:right;">
        <?php echo $_SESSION['userName'];?>
        <a href="index.php" style="text-align:left;">主页</a>
        <a href=<?php echo "selfZone.php?name=".$_SESSION['userName'];?>>我的空间</a>
        <a href=<?php echo "selfInfo.php?name=".$_SESSION['userName'];?>>我的信息</a>
        <a href="logout.php">退出</a>
    </div>
    <?php
}

$name = $_GET['name'];
echo "<h2> $name 的个人信息</h2>
        <hr size='2' />";

$db = new c_mysqli();
$db->connectMysql('MessageBoard', $config);
$sql = $db->mkQuery("SELECT * FROM UserInfo WHERE userName='$name'");
$num = mysqli_num_rows($sql);
if($num == 0||$num > 1) {
    die("ERROR: 数据异常");
}
$info = mysqli_fetch_array($sql);

echo "
    <table>
    <tr>
        <td>用户名：</td><td>" . $info['userName'] . "</td> 
    </tr>
    <tr>
        <td>姓名：</td><td>" . $info['Name'] . "</td>
    </tr>
    <tr>
        <td>性别：</td><td>" . ($info['Sex']?"女":"男") . "</td>
    </tr>
    <tr>
        <td>学校：</td><td>" . $info['School'] . "</td>
    </tr>
    <tr>
        <td>学院：</td><td>" . $info['Academy'] . "</td>
    </tr>
    <tr>
        <td>专业：</td><td>" . $info['Major'] . "</td>
    </tr>
    <tr>
        <td>手机：</td><td>" . $info['Mobile'] . "</td>
    </tr>
    <tr>
        <td>邮箱：</td><td>" . $info['Email'] . "</td>
    </tr>
    </table>
";

if(isset($_SESSION['userName']) && ($name == $_SESSION['userName'])) {
    echo "<a href='selfInfo_modify.php?name=" . $name . "'>修改</a>";
} 
?>
</body>
</html>