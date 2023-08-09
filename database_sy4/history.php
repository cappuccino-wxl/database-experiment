<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Query Lease History</title>
</head>

</html>

<div align="center">
    <img src="image/background2.png" class="bg">
    <img src="image/background4.png" class="bg">
    <img src="image/background3.png" class="bg">
    <!-- <table border="1"> -->
    <?php
    echo '<br>';
    echo '<h3>Query Lease History</h3>';
    echo '<br>';
    echo '<form method="GET" action="leaseHistory.php">';
    echo '<tr>';
    echo '<font size="4">Customer ID:</font>&nbsp&nbsp';
    echo '<input type="text" name="customerID" placeholder="Please enter a customer id"></input>';
    echo '<br>';
    echo '<br>';
    // 按钮
    echo '<input type="submit" value="Search" style="width:100px">';
    echo '</form>';
    ?>
    <!-- </table> -->
</div>
<?php
echo '<p>Enter your customer ID to view your rental history!</p>'; ?>
<link rel="stylesheet" href="style.css">