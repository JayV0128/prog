<?php
    require_once('conn.php');
    if (!empty($_POST)) {
        extract($_POST);
        var_dump($_POST);

        $sql = "UPDATE orders SET deliveryAddress='$deliveryAddress', deliveryDate='$deliveryDate' WHERE orderID=$orderID";
        $rs = mysqli_query($conn, $sql);
    }
    // var_dump(mysqli_affected_rows($conn));
    header("Location:ViewOrder.php");
mysqli_close($conn);
?>