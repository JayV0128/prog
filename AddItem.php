<?php
    require_once('conn.php');
    if (!empty($_POST)) {
        var_dump($_POST);
        extract($_POST);
        $sql = "INSERT INTO item(itemID, itemName, itemDescription, stockQuantity, price) VALUES ($itemID, '$itemName', '$itemDesc', $stockQuantity, $price)";
        $rs = mysqli_query($conn, $sql);
    }
    mysqli_close($conn);
    header("Location:InsertItem.php");
?>