<?php
require_once('conn.php');

if (!empty($_POST)) {
    var_dump($_POST);
    extract($_POST);
}

session_start();
foreach ($_SESSION['cart'] as $key => $val) {
    $sql = "SELECT * FROM item WHERE itemID=$key";
    $rs = mysqli_query($conn, $sql);
    while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);
    }

    $quan = $val;
    $total += $quan * $price;
}

$sql = "INSERT INTO orders(orderID, customerEmail, staffID, dateTime, deliveryAddress, deliveryDate, orderAmount)
            VALUES ($orderID, '$custEmail', '$staffID', null, '$deliveryAddress', '$deliveryDate', $total)";
$rs = mysqli_query($conn, $sql);

foreach ($_SESSION['cart'] as $key => $val) {
    $sql = "SELECT * FROM item WHERE itemID=$key";
    $rs = mysqli_query($conn, $sql);
    while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);
    }

    $id = $key;
    $qty = $val;
    $totalprice = $qty * $price;
    $sql = "INSERT INTO `itemorders`(`orderID`, `itemID`, `orderQuantity`, `soldPrice`) VALUES ($orderID, $id, $qty, $totalprice)";
    $rs = mysqli_query($conn, $sql);
}
mysqli_close($conn);
header("Location:PlaceOrder.php");
?>