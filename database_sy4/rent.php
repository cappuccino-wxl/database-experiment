<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</html>

<?php
include("conn.php");
//表单信息
$customerID = $_GET['customer_id'];
$bagID = $_GET['bag_id'];
//$DateRent = $_GET['DateRent'];
$DateRent = Date("Y-m-d");
$DateReturn = $_GET['DateReturn'];
$Insurance = $_GET['Insurance'];
$bag_state = 'rent';

//异常检测------------------
if ($Insurance != 1 and $Insurance != 0) {
    echo '<script>alert("Operation failed! Insurance is uncorrect!");window.location.href=document.referrer;</script>';
    die("Insurance is uncorrect");
}
// 日期格式：××××-××-××
if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $DateReturn)) {
    echo '<script>alert("Operation failed! Date is uncorrect!");window.location.href=document.referrer;</script>';
    die("Date is uncorrect");
}
$tmp_sql = 'select * from customer where customer_id = "' . $customerID . '"';
$tmp_res = mysqli_query($conn, $tmp_sql);
if (mysqli_num_rows($tmp_res) == 0) {
    echo '<script>alert("Operation failed! Customer ID does not exist!");window.location.href=document.referrer;</script>';
    die("CustomerID is uncorrect");
}

//进行租借操作
//租借就是：往rentals表格里insert，触发trigger然后将bags里对应的num--
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
                "' . $DateReturn . '",
                "' . $Insurance . '",
                "' . $bagID . '",
                "' . $bag_state . '"
            );';
//进行查询
// echo '<td>'.$sql.'</td>';
$res = mysqli_query($conn, $sql);
echo '<script>alert("Operation succeeded!");window.location.href=document.referrer;</script>';
die("114514");
?>