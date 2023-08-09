<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Table Details</title>
</head>

</html>
<div align="center">
    <img src="image/background2.png" class="bg">
    <img src="image/background4.png" class="bg">
    <img src="image/background3.png" class="bg">
    <table border="1">
        <?php
        include("conn.php");

        // 检验提交参数
        if (!isset($_GET["tableName"])) {
            die("请选择数据表");
        }
        $tableName = $_GET["tableName"];
        echo '<br>';
        echo '<h3>Details of Table: ' . $tableName . '</h3>';
        echo '<br>';

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
        echo '<tr>'; //回车
        
        // ---------------打印数据----------------
        $res = mysqli_query($conn, "call show_" . $tableName);
        $row = mysqli_num_rows($res);
        // 遍历每行
        for ($i = 0; $i < $row; $i++) {
            echo '<form method="GET" action="tables.php"><tr>';
            $dbrow = mysqli_fetch_array($res);
            $url = "tables.php?tableName=" . $tableName . '&'; // 构造get提交的url 
            // 按列循环打印属性
            for ($j = 0; $j < count($columns); $j++) {
                $key = $columns[$j]; // 属性名
                $val = $dbrow[$key]; // 属性值值
                echo '<td><input name="' . $key . '" value="' . $val . '" class="in"></td>';
                $url .= $key . '=' . $val . '&';
            }
            $url .= 'opType=delete';
            // 隐藏字段: 表名和操作类型
            echo '<input name="tableName" value="' . $tableName . '" style="display:none;">';
            echo '<input name="opType" value="update" style="display:none;">';
            // 按钮
            echo '<td><div class="his"><input type="submit" value="Modify" style="width:60px"> ';
            echo '<a href="' . $url . '" style="font-size: 16px;">Delete</a></div></td>';
            echo '</tr></form>';
        }
        echo '<tr>';

        //这里是一个表单，用以提交插入请求
        echo '<form method="GET" action="tables.php">';

        // 打印插入栏
        foreach ($columns as $key) {
            echo '<td><input name="' . $key . '" value="" class="in"></input></td>';
        }
        // 按钮
        echo '<td><input type="submit" value="Insert" style="width:60px;"  class="in">';
        // 隐藏字段: 表名和操作类型
        echo '<input name="tableName" value="' . $tableName . '" style="display:none;"  class="in">';
        echo '<input name="opType" value="Insert" style="display:none;"  class="in">';
        echo '</tr></form>';
        ?>
    </table>
    <?php
    if ($row == 0) {
        echo "表中没有记录";
    }
    ?>
</div>    <link rel="stylesheet" href="style.css">
