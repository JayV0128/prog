<?php
require_once('conn.php');
extract($_POST);
//var_dump($_POST);

if (isset($btnEdit))
    header("Location:EditItem.php?id=$id");

if (isset($btnDelete)){
    $sql = "DELETE FROM item WHERE itemID=$id";
    $rs = mysqli_query($conn, $sql);
    header("Location:InsertItem.php");
}
mysqli_close($conn);
?>
