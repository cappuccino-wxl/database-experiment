<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Search Best Customer</title>
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
        echo '<h3>Search Best Customer</h3>';
        echo '<br>';

        //打印表头
        $columns = array('Last_name', 'First_name', 'Address', 'Telephone', 'Total_Length_of_Rentals');
        echo '<tr>';
        for ($i = 0; $i < count($columns); $i++) {
            echo '<th><b>' . $columns[$i] . '</b></th>';
        }
        echo '</tr><tr>'; //回车
        //打印数据
        $res = mysqli_query($conn, 'call best_customer()');
        $row = mysqli_num_rows($res);
        // 遍历每行
        for ($i = 0; $i < $row; $i++) {
            //echo '<form method="GET" action="table.bks.php"><tr>';
            $dbrow = mysqli_fetch_array($res);
            // 按列循环打印属性
            for ($j = 0; $j < count($columns); $j++) {
                $key = $columns[$j]; // 属性名
                $val = $dbrow[$j]; // 属性值值
                // echo '<td><input name="' . $key . '" value="' . $val . '" class="his"></td>';
                echo '<td><div class="his">' . $val . '</div></td>';
            }
            echo '</tr></tr>';
        }
        ?>

    </table>


    <?php
    if ($row == 0) {
        echo "表中没有记录";
    }
    ?>
</div>
<link rel="stylesheet" href="../style.css">