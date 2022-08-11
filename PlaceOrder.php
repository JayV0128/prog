<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order - Salesperson</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <link rel="stylesheet" href="ViewOrder.css">
    <link rel="stylesheet" href="PlaceOrder.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="PlaceOrder.js"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Better Limited - Placing Orders</h1>
    </div>
    <div class="loginInfo">
        <!--Obtain staff name from database to change the value in welcome message-->
        <?php
            session_start();
            $staffName = $_SESSION['staffName'];
            $sid = $_SESSION['staffID'];
        ?>
        <input type="text" name="welSname" id="welSname" readonly value="Welcome back, <?php echo $staffName; ?>!">
        <a href="menuSalesperson.php"><input type="button" name="menus" id="menus" value="Menu"></a>
        <a href="ViewOrder.php"><input type="button" name="item" id="item" value="Orderlist"></a>
        <a href="PlaceOrder.php"><input type="button" name="customer" id="customer" value="New Order"></a>
        <a href="index1.php"><input type="button" name="logout" id="logout" value="Log out"></a>
    </div>
    <div class="viewitem">
        <form action="PlaceOrder.php" method="post">
            Search for Item:
            <input type="text" name="id" id="id" placeholder="Enter Item ID" onchange="checkItem();">
            <!--check item ID format and show error message if it is invalid-->
            <span class="showError"></span>
            Choose:
            <input type="radio" name="showstock" value="Y"> Show
            <input type="radio" name="showstock" value="N"> Hidden
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
            <!--display the create order form after clicking-->
            <input type="button" name="createOrderMode" id="createOrderMode" value="Create Order: Off" onclick="createMode(); return false;">
        </form>
    </div>
    <!--showing available items, when no items are available, a "none" message will be shown.-->
    <!--Get item records through database-->
    <div class="showAvailableItems" id="showAvailableItems">
        <table border="1" id="itemTable">
            <tr>
                <th class="itemID">Item ID</th>
                <th class="itemName">Item Name</th>
                <th class="stockQty">Stock Quantity</th>
                <th class="itemPrice">Item Price</th>
                <th></th>
            </tr>
            <!--Call database to obtain items' details "example below"-->
            <!--Click AddtoOrder will transfer the ItemID to the place order function-->
            <!--Sample Data-->
            <?php
            require_once('conn.php');
            extract($_POST);
            // var_dump($_POST);
            if (!empty($id) && empty($showstock)) {
                $sql = "SELECT itemID, itemName, stockQuantity, price FROM item WHERE itemID='$id'";
            } else {
                if (!empty($showstock) && $showstock == "Y") {
                    $sql = "SELECT itemID, itemName, stockQuantity, price FROM item";
                } else {
                    $sql = "SELECT itemID, itemName, stockQuantity, price FROM item WHERE stockQuantity>0";
                }
            }

            $rs = mysqli_query($conn, $sql);
            while ($rc = mysqli_fetch_assoc($rs)) {
                extract($rc);
                printf('<tr>
                                   <td>%s</td>
                                   <td>%s</td>
                                   <td>%s</td>
                                   <td>%s</td>
                                   <td>
                                      <form method="post" action="addItemID.php">
                                          <button id="btnAddtoOrder" name="btnAddtoOrder">Add Cart</button>
                                          <input type="number" name="itemqty" id="itemqty" value="1">
                                          <button name="cart" id="cart">Clear Cart</button>
                                          <input type="hidden" name="itemid" value="%s">
                                      </form>
                                   </td>
                                 </tr>', $itemID, $itemName, $stockQuantity, $price, $itemID);
            }
            ?>
        </table>
    </div>
    <!-- orderID will be generated after the item is created successfully -->
    <div class="createOrder" id="createOrder">
        <form action="create.php" method="post" id="createform">
            <div class="Addorder">
                <!--generated automatically-->
                <div class="staffid">
                    Staff ID: <input type="text" name="staffID" id="staffID" value="<?php echo $sid; ?>" readonly>
                </div>
                <div class="itemid">
                    <table>
                        <th>Item ID</th>
                        <th>Quantity</th>
                    <?php
                    foreach ($_SESSION['cart'] as $key => $val) {
                        printf('<tr>
                                          <td><input type="text" value="%s" name="itemID" id="itemID" readonly></td>
                                          <td><input type="text" value="%s" name="quan" id="quan"></td>
                                       </tr>', $key, $val);
                    }
                    mysqli_close($conn);
                    ?>
                    </table>
                </div>
            </div>
            <div class="Addcustomer">
                <div class="customerEmail">
                    Customer's Email: <input type="text" name="custEmail" id="custEmail" placeholder="e.g. xxx@gmail.com">
                </div>
                <div class="address">
                    Delivery Address: <textarea name="deliveryAddress" id="deliveryAddress" cols="50" rows="5" placeholder="Enter delivery address..."></textarea>
                </div>
                <div class="deliverydate">Delivery Date: <input type="text" name="deliveryDate" id="deliveryDate" placeholder="Enter in YYYY/MM/DD">
                </div>
                <div class="btn" id="btn">
                    <!--click and call function to check the input fields and submit the form.-->
                    <button type="button" name="btnCreate" onclick="return checkOrderInfo();return false;">Confirm</button>
                    <button type="button" name="btnClear" onclick="resetFields();">Clear Fields</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body></html>

