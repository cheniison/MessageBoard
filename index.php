<?php
require_once('include.php');
session_start();
$config = array('HOST' => HOST, 'USERNAME' => USERNAME, 'PASSWORD' => PASSWORD );
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Message Board</title>
    <style type="text/css">
        .leaveMessage {
            text-align: center;
        }
        .Message {
            text-align: center;
        }
    </style>
    <script type="text/javascript">
        function checkText()
        {
            var islogin=<?php echo isset($_SESSION['userName'])?"1":"0";?>;

            if(!islogin) {
                alert("请先登录！");
                return false;
            }
            if(document.getElementById('sub').value.length>20) {
                alert("主题字数过多!");
                document.getElementById('sub').focus();
                return false;
            }
            if(document.getElementById('text').value.length>200) {
                alert("留言字数过多!");
                document.getElementById('text').focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<?php
if(!isset($_SESSION['userName'])) {
    ?>
    <div style="text-align:right;">
        您好，请先<a href="login.php">登录</a>
    </div>
    <?php
} else {
    ?>
    <div style="text-align:right;">
    <?php echo $_SESSION['userName'];?>
        <a href=<?php echo "selfZone.php?name=".$_SESSION['userName'];?>>我的空间</a>
        <a href=<?php echo "selfInfo.php?name=".$_SESSION['userName'];?>>我的信息</a>
        <a href="logout.php">退出</a>
    </div>
    <?php
}
?>
<form action="submit_deal.php" method="post" onsubmit="return checkText()">
    <div class="leaveMessage">
        <label for="subject">主题：</label><input type="text" name="sub" id="sub" placeholder="主题（少于20字）" required>
    </div>
    <br/>
    <div class="leaveMessage">
        <textarea name="text" id="text" style="resize:none;" rows="7" cols="30" placeholder="请在这里写下您的留言（少于50字）" required></textarea>
        <br/>
        <input type="reset" name="reset" value="重置">
        <input type="submit" name="submit" value="留言">
    </div>
</form>
<hr width="80%" color=#987cb9 size="5" />
<div class="Message">
    <h2 >留言板</h2>
    <?php
        $db = new c_mysqli();
        $db->connectMysql('MessageBoard', $config);

        $offset = (isset($_GET['pagenum'])?$_GET['pagenum']-1:0)*10;
        $result = $db->mkQuery("SELECT * FROM Message LIMIT $offset,10");
        ?>
        <table align="center" frame="void" rules="all" width="1000px" style="table-layout:fixed;">
        <tr><th width="100px">用户名</th><th width="500px">留言</th><th width="100px">留言时间</th><th width="40px">操作</th></tr>
        <?php
        if(function_exists('date_default_timezone_set')) {
            //判断是否已经存在date_default_timezone_set，本函数是php5.1.x中新加的函数
            date_default_timezone_set('PRC');//设置时区以符合本地时间
        }
        $row_arr = $db->findAll($result);
        showMessageArr($row_arr, 0);
        echo "</table>";
        
        $total=mysqli_num_rows($db->mkQuery("select * from Message")); //查询数据的总数total
        $curr=(isset($_GET['pagenum'])?$_GET['pagenum']:1);//当前页
        showPage($total, $curr, "index");

        $db->closeConnection();
        
    ?>

</body>
</html>