<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Items - Manager</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <link rel="stylesheet" href="ViewOrder.css">
    <link rel="stylesheet" href="EditItem.css">
    <script src="EditItem.js"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Better Limited - Edit Items</h1>
    </div>
    <div class="loginInfo">
        <!--Obtain staff name from database to change the value in welcome message-->
        <?php
            session_start();
            $staffName = $_SESSION['staffName'];
        ?>
        <input type="text" name="welSname" id="welSname" readonly value="Welcome back, <?php echo $staffName; ?>!">
        <a href="menuManager.php"><input type="button" name="menum" id="menum" value="Menu"></a>
        <a href="InsertItem.php"><input type="button" name="item" id="item" value="Item"></a>
        <a href="DeleteCustomer.php"><input type="button" name="customer" id="customer" value="Customer"></a>
        <a href="GenerateReport.php"><input type="button" name="customer" id="staff" value="Staff"></a>
        <a href="index1.php"><input type="button" name="logout" id="logout" value="Log out"></a>
    </div>
    <div class="itemdetails">
        <h3>Editing Item:</h3>
        <form action="EditItem.php" method="post" id="editForm">
            <!--generated automatically-->
            <?php
                require_once('conn.php');
                if (isset($_GET['id'])) {
                    extract($_GET);
                    // var_dump($_GET);

                    $sql = "SELECT * FROM Item WHERE itemID=$id";
                    $rs = mysqli_query($conn, $sql);
                    while ($rc = mysqli_fetch_assoc($rs)) {
                        extract($rc);
                        // var_dump($rc);
                    }
                }
            ?>
            <div class="itemid">Item ID: <input type="text" name="itemID" id="itemID" value="<?php echo $itemID; ?>" readonly></div>
            <div class="itemname">Item Name: <input type="text" name="itemName" id="itemName" value="<?php echo $itemName; ?>" readonly></div>
            <!--set the limited of words to 50 by php-->
            <div class="itemdesc">
                Item Description: <br>
                <textarea cols="70" rows="7" placeholder="Enter Item Description..." id="itemDesc" name="itemDesc"><?php echo $itemDescription; ?></textarea>
            </div>
            <div class="stockquantity">
                Stock Quantity:
                <input type="number" name="stockQuantity" id="stockQuantity" min="0" value="<?php echo $stockQuantity; ?>">
            </div>
            <div class="price">Price: $<input type="text" name="price" id="price" pattern="^[0-9]*$" value="<?php echo $price; ?>"></div>
        </form>
        <div class="btn">
            <!--Call database to update the edited item details-->
            <button type="button" id="btnUpdate" onclick="return checkItemDetails();return false;">Update Item</button>
            <?php
                if (!empty($_POST)) {
                    extract($_POST);
                    var_dump($_POST);

                    $sql = "UPDATE item SET itemName='$itemName', itemDescription='$itemDesc', stockQuantity=$stockQuantity, price=$price WHERE itemID=$itemID";
                    $rs = mysqli_query($conn, $sql);
                    // var_dump(mysqli_affected_rows($conn));
                    header("Location:InsertItem.php");
                }
                mysqli_close($conn);
            ?>
            <button type="button" id="btnClear" onclick="window.location.reload();">Clear Fields</button>
            <button id="btnClose"><a href="InsertItem.php">Close</a></button>
        </div>
    </div>
</div>
</body>
</html>