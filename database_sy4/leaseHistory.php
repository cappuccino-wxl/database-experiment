<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Lease History</title>
</head>

</html>
<div align="center">
    <img src="image/background2.png" class="bg">
    <img src="image/background4.png" class="bg">
    <img src="image/background3.png" class="bg">
    <table border="1">
        <?php
        include("conn.php");
        $customerID = $_GET['customerID'];
        echo '<br>';
        echo '<h3>Lease History of CustomerID: ' . $customerID . '</h3>';
        echo '<br>';


        //异常检测------------------
        $tmp_sql = 'select * from customer where customer_id = "' . $customerID . '"';
        $tmp_res = mysqli_query($conn, $tmp_sql);
        if (mysqli_num_rows($tmp_res) == 0) {
            echo '<script>alert("Operation failed! Customer ID does not exist!");window.location.href=document.referrer;</script>';
            die("customerID is uncorrect");
        }

        //打印表头
        $columns = array('customer_id', 'bag_id', 'Name', 'Color', 'Manufacturer', 'Insurance', 'Price', 'DateRent', 'DateReturn');
        echo '<tr>';
        for ($i = 0; $i < count($columns); $i++) {
            echo '<th><b>' . $columns[$i] . '</b></th>';
        }
        echo '<th><b>操作</b></th>';
        echo '</tr><tr>'; //回车
        
        //打印数据
        $res = mysqli_query($conn, 'call record_by_customerID("' . $customerID . '")');
        $row = mysqli_num_rows($res);

        // 遍历每行
        for ($i = 0; $i < $row; $i++) {
            //每一列都是一个表单
            echo '<form method="GET" action="return.php"><tr>';
            $dbrow = mysqli_fetch_array($res);
            // 按列循环打印属性
            for ($j = 0; $j < count($columns); $j++) {
                $key = $columns[$j]; // 属性名
                $val = $dbrow[$j]; // 属性值值
                // echo '<td><div class="his">' . $val . '</div></td>';
                echo '<td><input name="' . $key . '" value="' . $val . '" class="his"></td>';
            }
            echo '<td><input type="submit" value="Reture" style="width:70px"> '; //按钮
            echo '</tr></tr>'; //换行
            echo '</tr></form>';
        }

        ?>
    </table>
    <?php
    echo '<br>';

    echo '<p>The current date: ' . date("Y-m-d") . '</p>';

    ?>
</div>
<link rel="stylesheet" href="style.css">