<?php

require_once('conn.php');
extract($_POST);
var_dump($_POST);

if (isset($btnUpdateOrder))
    header("Location:OrderDetails.php?orderID=$orderID");

if (isset($btnDelete)) {
    $sql = "DELETE FROM itemorders WHERE orderID=$orderID";
    $rs = mysqli_query($conn, $sql);

    $sql = "DELETE FROM orders WHERE orderID=$orderID";
    $rs = mysqli_query($conn, $sql);

    header("Location:ViewOrder.php");
}
mysqli_close($conn);
?>
