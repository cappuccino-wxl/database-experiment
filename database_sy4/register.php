<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Register</title>
</head>

</html>
<div align="center">
    <img src="image/background2.png" class="bg">
    <img src="image/background4.png" class="bg">
    <img src="image/background3.png" class="bg">
    &emsp;&emsp;&emsp;&emsp;

    <table border="1">
        <style type="text/css">
            h1 {
                font-size: 200%
            }
        </style>

        <?php
        include("conn.php");
        echo '<br>';
        echo '<h3>Register a New Account</h3>';
        echo '<br>';

        $tableName = "customer";

        // 打印表头
        $columns = array();
        $res = mysqli_query($conn, "show columns from " . $tableName);
        $row = mysqli_num_rows($res);
        echo '<tr>';
        for ($i = 0; $i < $row; $i++) {
            $dbrow = mysqli_fetch_array($res);
            echo '<th><b>' . $dbrow[0] . '</b></th>';
            array_push($columns, $dbrow[0]);
        }
        echo '<th><b>操作</b></th>';

        //这里是一个表单，用以提交插入请求
        echo '</tr><form method="GET" action="tables.php"><tr>';

        // 打印插入栏
        foreach ($columns as $key) {
            echo '<td><input name="' . $key . '" value=""  class="in"></td>';
        }
        // 按钮
        echo '<td><input type="submit" value="Register" style="width:80px"  class="in"></td>';
        // 隐藏字段: 表名和操作类型
        echo '<input name="tableName" value="' . $tableName . '" style="display:none;"  class="in">';
        echo '<input name="opType" value="insert" style="display:none;"  class="in">';
        echo '</tr></form>';
        ?>

    </table>


    <?php
    if ($row == 0) {
        echo "表中没有记录";
    }
    ?>
</div>

<link rel="stylesheet" href="style.css">