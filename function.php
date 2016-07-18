<?php

/*
*显示留言
*/
function showMessageArr($message_arr, $flag)
{
    switch($flag)
    {
        case 0:
            $from = "index.php";
            break;
        case 1:
            $from = "selfZone.php";
    }
    foreach ($message_arr as $value) {
        echo "<tr>";
        if(!$flag) {
            echo "<td height='50px'>"."<a href='selfZone.php?name=".$value['Name']."'>".$value['Name']."</a>"."</td>";
        }
        echo "<td style='WORD-WRAP:break-word;' width='500px' align='left'>
            <li>主题：".$value['Subject']."</li>
            <li>留言：".$value['Message']."</li>
            </td>";//WORD-WRAP:break-word自动换行
        echo "<td>".date("Y-m-d H:i",$value['Time'])."</td>";
        echo "<td>".(isset($_SESSION['userName'])&&$_SESSION['userName']==$value['Name']?("<a href='delete.php?id=".$value['id']."&from=".$from."'>删除</a>"):"点赞")."</td>";
        echo "</tr>";
    }
}

/*
*显示所在页数
*/
function showPage($total, $curr, $from)
{
    $pagenum=ceil($total/10.0);      //总页数 pagenum
    
    if($curr!=1)
    {
        echo "<a href='". $from .".php?'>首页</a> ";
        echo "<a href='". $from .".php?pagenum=".($curr-1)."'>上一页</a> ";
    }
    if($curr>3)
    {
        echo "...";
    }
    for($i=($curr>3?$curr-2:1);$i<=($pagenum-2>$curr?$curr+2:$pagenum);++$i)
    {
        echo $i==$curr?"<b>$i</b> ":"<a href='". $from .".php?pagenum=".$i."'>$i</a> ";
    }
    if($curr+2<$pagenum)
    {
        echo "...";
    }
    if($curr!=$pagenum&&($pagenum!=1&&$pagenum!=0))
    {
        echo "<a href='". $from .".php?pagenum=".($curr+1)."'>下一页</a> ";
        echo "<a href='". $from .".php?pagenum=".$pagenum."'>末页</a> ";
    }
    if($total==0)
    {
        echo "暂无评论";
    }
}

/*
*处理输入的数据，防注入
*/
function deal_input($data) 
{

    $data = nl2br($data);   
    return $data;
}
