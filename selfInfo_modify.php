<?php
require_once('include.php');
session_start();
$config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );

$db = new c_mysqli();
$db->connectMysql('MessageBoard', $config);
$name = $_GET['name'];
if(!(isset($_SESSION['userName']) && ($_SESSION['userName'] == $name))) {
    die("您没有权限！");
}

$sql = $db->mkQuery("SELECT * FROM UserInfo WHERE userName='$name'");
$num = mysqli_num_rows($sql);
if($num == 0||$num > 1) {
    die("ERROR: 数据异常");
}
$info = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>修改个人信息</title>
</head>
<body style="text-align:center">
<form  action="selfInfo_modify_deal.php" method="POST">
    <h2>修改个人信息</h2>
    <hr width="60%" size="2" />
    <input type="hidden" name="userName" value="<?php echo $name; ?>">
    姓名：<input type="text" name="Name" value="<?php echo $info['Name']; ?>" required>*
    <br/><br/>
    性别：
    <?php
    if($info['Sex']==0) {
        echo '    
            <input type="radio" name="sex" checked="checked">男
            <input type="radio" name="sex">女
        ';
    } else {
        echo '    
            <input type="radio" name="sex">男
            <input type="radio" name="sex" checked="checked">女
        ';
    }

    ?>
    <br/><br/>
    学校：<input type="text" value="<?php echo $info['School']; ?>" name="School">
    <br/><br/>
    学院：<input type="text" value="<?php echo $info['Academy']; ?>" name="Academy">
    <br/><br/>
    专业：<input type="text" value="<?php echo $info['Major']; ?>" name="Major">
    <br/><br/>
    手机：<input type="text" value="<?php echo $info['Mobile']; ?>" name="Mobile">
    <br/><br/>
    邮箱：<input type="text" value="<?php echo $info['Email']; ?>" name="Email">
    <hr width="60%" size="2" />
    验证码：
    <input type="text" name="passcode" ><img title="点击刷新" src="captcha.php" onclick="this.src='captcha.php?'+Math.random();">
    <br/><br/>
    <input type="reset" name="重置">
    <input type="submit" id="submit" value="修改">
</form>
</body>
</html>