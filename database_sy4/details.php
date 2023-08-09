<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Database Details</title>
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
        echo '<h3>Details of Database</h3>';
        echo '<br>';

        // 获取表名
        $res = mysqli_query($conn, "show tables");
        $row = mysqli_num_rows($res);
        echo '<div class="box">';
        for ($i = 0; $i < $row; $i++) {
            $tableName = mysqli_fetch_array($res)[0];
            echo '<a href="table.php?tableName=' . $tableName . '" class="home">' . $tableName . '</a>';
            echo '<br><br>';
        }
        echo '</div>';

        ?>
    </table>
</div>
<?php
echo '<p>You can see all the database information for this system!</p>'; ?>
<link rel="stylesheet" href="style.css">