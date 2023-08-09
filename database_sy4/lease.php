<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Lease Bags</title>
</head>

</html>
<div align="center">
    <img src="image/background2.png" class="bg">
    <img src="image/background4.png" class="bg">
    <img src="image/background3.png" class="bg">

    <table border="1">
        <?php
        include("conn.php");
        echo '<br>';
        echo '<h3>Lease Bags</h3>';

        //打印表头
        $columns = array('bag_id', 'customer_id', 'DateReturn', 'Insurance', '操作');
        echo '<tr>';
        for ($i = 0; $i < count($columns); $i++) {
            echo '<th><b>' . $columns[$i] . '</b></th>';
        }
        // echo '<td><b>操作</b></td>';
        echo '</tr><tr>'; //回车
        
        //表单中读入
        $bags_id = "";
        $bags_id = $_GET['bag_id'];

        echo '<form method="GET" action="rent.php">';
        echo '<tr>';
        //echo '<td><b name="bag_id">'.$bags_id.'</b></td>';
        echo '<td><input type="text" name="bag_id" value="' . $bags_id . '" style="width:120;"></input></td>';
        echo '<td><input type="text" name="customer_id" placeholder="Please enter..." style="width:200;"></input></td>';
        echo '<td><input type="text" name="DateReturn" placeholder="Please enter..." style="width:200;"></input></td>';
        echo '<td><input type="text" name="Insurance" placeholder="Please enter..." style="width:200;"></input></td>';
        // 按钮
        echo '<td><input type="submit" value="Lease" style="width:80px">';
        // 隐藏字段: 表名和操作类型
        echo '</tr>';
        echo '</form>';
        ?>
    </table>

</div>
<?php
echo '<br>';
echo '<p>Date format is ××××-××-××</p>';
echo '<p>Please remember to return it before the return date!</p>'; ?>
<link rel="stylesheet" href="style.css">