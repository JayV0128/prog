<?php

require_once('conn.php');
extract($_POST);


$sql = "SELECT orderID FROM orders WHERE customerEmail='$cemail'";
$rs = mysqli_query($conn, $sql);
while ($rc = mysqli_fetch_assoc($rs)) {
    extract($rc);
}

$deleteItemOrders = "DELETE FROM itemorders WHERE orderID=$orderID";
$rs = mysqli_query($conn, $deleteItemOrders);

$deleteOrders = "DELETE FROM orders WHERE orderID=$orderID";
$rs = mysqli_query($conn, $deleteOrders);

$deleteCustomer = "DELETE FROM customer WHERE customerEmail='$cemail'";
$rs = mysqli_query($conn, $deleteCustomer);

//var_dump(mysqli_affected_rows($conn));
header("Location:DeleteCustomer.php");
mysqli_close($conn);
?>
