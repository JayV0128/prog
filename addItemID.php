<?php
session_start();
if (!isset($_SESSION)) {
    $_SESSION['cart'];
}
if (isset($_POST['cart'])) {
    $_SESSION['cart'] = array();
} else {
    if (!empty($_POST['itemid'])) {
        var_dump($_POST);
        extract($_POST);
        $itemID = $itemid;
        $qty = $itemqty;

        if ($qty > 0) {
            if (isset($_SESSION['cart'][$itemID])) {
                $_SESSION['cart'][$itemID] += $qty;
            } else {
                $_SESSION['cart'][$itemID] = $qty;
            }
        }
    }
}
header("Location:PlaceOrder.php");
mysqli_close($conn);
?>