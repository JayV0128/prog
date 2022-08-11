<?php
require_once('conn.php');

if (!empty($_POST)) {
    extract($_POST);
}

session_start();
$total = 0;
foreach ($_SESSION['cart'] as $key => $val) {
    $sql = "SELECT * FROM item WHERE itemID=$key";
    $rs = mysqli_query($conn, $sql);
    while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);
    }

    $quan = $val;
    $total += $quan * $price;
}
$query = "SELECT MAX(orderID)+1 AS 'max' FROM orders";
$result = mysqli_query($conn, $query);
while ($r = mysqli_fetch_assoc($result)) {
    extract($r);
}

$sql2 = "INSERT INTO orders(orderID, customerEmail, staffID, dateTime, deliveryAddress, deliveryDate, orderAmount)
            VALUES ($max, '$custEmail', '$staffID', null, '$deliveryAddress', '$deliveryDate', $total)";
$rs = mysqli_query($conn, $sql2);

foreach ($_SESSION['cart'] as $key => $val) {
    $sql3 = "SELECT * FROM item WHERE itemID=$key";
    $rs = mysqli_query($conn, $sql3);
    while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);
    }

    $id = $key;
    $qty = $val;
    $totalprice = $qty * $price;
    $sql = "INSERT INTO `itemorders`(`orderID`, `itemID`, `orderQuantity`, `soldPrice`) VALUES ($max, $id, $qty, $totalprice)";
    $rs = mysqli_query($conn, $sql);
}
mysqli_close($conn);
header("Location:PlaceOrder.php");
?>