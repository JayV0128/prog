<?php
    require_once('conn.php');
    if (!empty($_POST)) {
        var_dump($_POST);
        extract($_POST);

        $query = "SELECT MAX(itemID) + 1 AS 'max' FROM Item";
        $result = mysqli_query($conn, $query);
        while ($rc = mysqli_fetch_assoc($result)) {
            extract($rc);
        }

        $sql = "INSERT INTO item(itemID, itemName, itemDescription, stockQuantity, price) VALUES ($max, '$itemName', '$itemDesc', $stockQuantity, $price)";
        $rs = mysqli_query($conn, $sql);
    }
    mysqli_close($conn);
    header("Location:InsertItem.php");
?>