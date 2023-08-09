<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Query Details</title>
</head>

</html>
<div align="center">
    <img src="image/background2.png" class="bg">
    <img src="image/background4.png" class="bg">
    <img src="image/background3.png" class="bg">
    <?php
    include("conn.php");
    echo '<br>';
    echo '<h3>Query More Details</h3>';
    echo '<br>';

    //查询manufactor
    echo '<form method="GET" action="manufactor.php">';
    echo '<tr>';
    echo 'Bags by Manufacturer: ';
    echo '<input type="text" name="manu_name" placeholder="Please enter name of a manufacturer" style="width:300px"></input>&nbsp&nbsp';
    // 按钮
    echo '<input type="submit" value="Search" style="width:70px">';
    // 隐藏字段: 表名和操作类型
    echo '</tr>';
    echo '</form>';
    ?>

    <tr>
    <tr>

        <?php
        //查询用户购买记录
        echo '<form method="GET" action="report_customer_amount.php">';
        echo '<tr>';
        // 打印manu的文本
        echo 'report customer amount: ';
        echo '<input type="text" name="customerID" placeholder="Please enter customer ID" style="width:300;"></input>&nbsp&nbsp';
        // 按钮
        echo '<input type="submit" value="Search" style="width:70px">';
        echo '</tr>';
        echo '</form>';
        ?>
    <tr>
    <tr>

        <?php
        //数据库功能二，查询最佳用户
        echo '<form method="GET" action="best_customer.php">';
        echo '<tr>';
        // 打印manu的文本
        echo 'Best Customers: ';
        // 按钮
        echo '<input type="submit" value="Search" style="width:70px">';
        echo '<tr>';
        echo '</form>';
        ?>
    <tr>
</div>
<link rel="stylesheet" href="style.css">