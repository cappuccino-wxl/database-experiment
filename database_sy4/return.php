<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</html>

<?php
include("conn.php");
//表单信息
$customerID = $_GET['customer_id'];
$bagID = $_GET['bag_id'];
$DateRent = $_GET['DateRent'];
$DateReturn = $_GET['DateReturn'];
$Insurance = $_GET['Insurance'];
$Price = $_GET['Price'];
$bag_state = 'return';
//进行归还操作
//构造sql
$sql = 'insert into rentals(
            customer_id, 
            DateRent,
            DateReturn,
            Insurance,
            bag_id,
            bag_state
            ) values (
                "' . $customerID . '",
                "' . $DateRent . '",
                "' . Date("Y-m-d") . '",
                "' . $Insurance . '",
                "' . $bagID . '",
                "' . $bag_state . '"
            );';
//进行查询
// echo '<td>'.$sql.'</td>';
$res = mysqli_query($conn, $sql);
$tmp = mysqli_query($conn, 'call rent2down');

//计算花费金额
$DateReturn = strtotime($DateReturn);
$DateRent = strtotime($DateRent);
$diffTime = round(($DateReturn - $DateRent) / 3600 / 24);
$money_toPay = $diffTime * $Price;
//保险费
if ($Insurance == 1) {
    $money_toPay = $money_toPay + $diffTime;
}

echo '<script>alert("Return succeeded! Cost ' . $money_toPay . '");window.location.href=document.referrer;</script>';
die("114514");
?>