<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Details of Bags</title>
</head>

</html>

<head>
    <title>Details of Bags</title>
</head>

<div align="center">
    <img src="image/background2.png" class="bg">
    <img src="image/background4.png" class="bg">
    <img src="image/background3.png" class="bg">
    <table border="1">
        <?php
        include("conn.php");
        echo '<br>';
        echo '<h3>Details of Bags</h3>';
        //打印表头
        $columns = array('bag_id', 'names', 'Color', 'Manufacturer', 'Price', 'nums');
        for ($i = 0; $i < count($columns); $i++) {
            echo '<th><b>' . $columns[$i] . '</b></th>';
        }
        echo '<th><b>操作</b></th>';
        echo '<tr>'; //回车
        

        //打印数据,调用bags_avaliable()
        $res = mysqli_query($conn, 'call bags_avaliable()');
        $row = mysqli_num_rows($res);
        // 遍历每行
        for ($i = 0; $i < $row; $i++) {
            //这里进行租借计算
            echo '<form method="GET" action="lease.php"><tr>';
            $dbrow = mysqli_fetch_array($res);
            // 按列循环打印属性
            for ($j = 0; $j < count($columns); $j++) {
                $key = $columns[$j]; // 属性名
                $val = $dbrow[$j]; // 属性值值
                echo '<td><input name="' . $key . '" value="' . $val . '" class="his"></td>';
            }
            echo '<td><input type="submit" value="Lease" style="width:60px"> '; //按钮
            echo '</tr></tr>'; //换行
            echo '</tr></form>';
        }
        ?>
    </table>
    <br>

</div>

<link rel="stylesheet" href="style.css">