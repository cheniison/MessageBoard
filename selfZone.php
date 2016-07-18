<?php
require_once('include.php');
session_start();
$config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );

$name = (isset($_GET['name'])?$_GET['name']:$_SESSION['userName']);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title><?php echo $name . "的空间" ?></title>
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
?>
<h2><?php echo $name."的空间" ?></h2>
<div style="text-align:center;">
<?php
        $db = new c_mysqli();
        $db->connectMysql('MessageBoard',$config);

        $offset = (isset($_GET['pagenum'])?$_GET['pagenum']-1:0)*10;
        $result = $db->mkQuery("SELECT * FROM Message WHERE Name='$name' LIMIT $offset,10");
        while($rs = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $list[] = $rs;
        }

        ?>
        <table align="center" frame="void" rules="all" width="1000px" style="table-layout:fixed;">
        <tr><th width="500px">留言</th><th width="100px">留言时间</th><th width="30px">操作</th></tr>
        <?php
        if(function_exists('date_default_timezone_set')) {
            //判断是否已经存在date_default_timezone_set，本函数是php5.1.x中新加的函数
            date_default_timezone_set('PRC');//设置时区以符合本地时间
        }
        
        showMessageArr($list, 1);

        echo "</table>";
        $total=mysqli_num_rows($db->mkQuery("select * from Message WHERE Name='$name'")); //查询数据的总数total
        $curr=(isset($_GET['pagenum'])?$_GET['pagenum']:1);//当前页
        showPage($total, $curr, "selfZone");

        mysqli_free_result($result);//释放结果集

        $db->closeConnection();
?>
</div>
</body>
</html>