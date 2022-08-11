<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details - Salesperson</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <link rel="stylesheet" href="OrderDetails.css">
    <link rel="stylesheet" href="ViewOrder.css">
    <script src="OrderDetails.js"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Better Limited - Order Details</h1>
    </div>
    <div class="loginInfo">
        <!--Obtain staff name from database to change the value in welcome message-->
        <?php
            session_start();
            $staffName = $_SESSION['staffName'];
        ?>
        <input type="text" name="welSname" id="welSname" readonly value="Welcome back, <?php echo $staffName; ?>!">
        <a href="menuSalesperson.php"><input type="button" name="menus" id="menus" value="Menu"></a>
        <a href="ViewOrder.php"><input type="button" name="item" id="item" value="Orderlist"></a>
        <a href="PlaceOrder.php"><input type="button" name="customer" id="customer" value="New Order"></a>
        <a href="index1.php"><input type="button" name="logout" id="logout" value="Log out"></a>
    </div>
    <div class="orderdetails">
        <!--Generate with database record and the orderID selected in the previous page-->
        <!--Showing Sample Data with orderID is 1-->
        <?php
        require_once('conn.php');
        if (isset($_GET['orderID'])) {
            extract($_GET);

            $sql = "SELECT * FROM orders,customer,staff WHERE customer.customerEmail=orders.customerEmail AND staff.staffID=orders.staffID AND orders.OrderID = $orderID";
            $rs = mysqli_query($conn, $sql);
            while ($rc = mysqli_fetch_assoc($rs)) {
                extract($rc);
            }
        }
        ?>
        <form action="updateOrder.php" method="post" id="orderform">
            <div class="orderInfo">
                <div class="info">
                    <h4>Order Information</h4>
                </div>
                <div class="orderid">Order ID: <input type="text" name="orderID" readonly value="<?php echo $orderID; ?> "></div>
                <div class="timestamp">Order Date &amp; Time: <input type="datetime" name="time" value="<?php echo $dateTime; ?>" readonly></div>
            </div>
            <div class="custInfo">
                <div class="info">
                    <h4>Customer Information</h4>
                </div>
                <div class="customerName">Customer's Name: <input type="text" name="custName" readonly value="<?php echo $customerName; ?>"></div>
                <div class="customerEmail">Customer's Email: <input type="text" name="custEmail" readonly value="<?php echo $customerEmail; ?>"></div>
                <div class="customerPhone">Customer's Phone: <input type="text" name="custPhone" readonly value="<?php echo $phoneNumber; ?>"></div>
            </div>
            <div class="staffInfo">
                <div class="info">
                    <h4>Staff Information</h4>
                </div>
                <div class="staffid">Staff ID: <input type="text" name="staffID" readonly value="<?php echo $staffID; ?>"></div>
                <div class="staffname">Staff Name: <input type="text" name="staffName" readonly value="<?php echo $staffName; ?>"></div>
            </div>
            <div class="deliveryInfo">
                <div class="info">
                    <h4>Delivery Information</h4>
                </div>
                <div class="deliveryaddress">Delivery Address: <input type="text" name="deliveryAddress" id="deliveryAddress" value="<?php echo $deliveryAddress; ?>"></div>
                <div class="deliverydate">Delivery Date: <input type="text" name="deliveryDate" id="deliveryDate" placeholder="Enter in YYYY/MM/DD" value="<?php echo $deliveryDate; ?>"></div>
            </div>
        </form>
    </div>
    <!--Generate a table showing item(s) ordered desc ID + Name + Qty + Total-->

    <!--Showing Sample Data with orderID is 1-->
    <div class="itemsordered">
        <div class="itemheader">Items Ordered</div>
        <table border="1">
            <tr>
                <th class="itemID">Item ID</th>
                <th class="itemName">Item Name</th>
                <th class="qty">Ordered Quantity</th>
                <th class="total">Amount</th>
            </tr>
            <?php
                $sql = "SELECT item.itemID, itemName, orderQuantity, soldPrice FROM item, itemorders WHERE item.itemID=itemorders.itemID AND orderID=$orderID GROUP BY itemorders.itemID ORDER BY itemName DESC";
                $rs = mysqli_query($conn, $sql);
                while ($rc = mysqli_fetch_assoc($rs)) {
                    extract($rc);
                    // var_dump($rc);

                    printf('<tr>
                                      <td>%s</td>
                                      <td>%s</td>
                                      <td>%s</td>
                                      <td>%s</td>
                                   </tr>', $itemID, $itemName, $orderQuantity, $soldPrice);
                }
            ?>
        </table>
        <!--display total quantity and price of the order, obtain from database with calculation-->
        <div class="totalQtyPrice">
            <?php
                $sql = "SELECT SUM(orderQuantity) AS 'count', orderAmount FROM itemorders,orders WHERE orders.orderID=itemorders.orderID AND orders.orderID=$orderID";
                $rs = mysqli_query($conn, $sql);
                while ($rc = mysqli_fetch_assoc($rs)) {
                    extract($rc);
                    // var_dump($rc);
                }
            ?>
            Total Quantity Ordered: <input type="text" name="totalqty" id="totalqty" readonly value="<?php echo $count; ?>">
            Total Amount: <input type="text" name="totalamount" id="totalamount" readonly value="<?php echo $orderAmount; ?>">
        </div>
    </div>
    <div class="btn">
        <!--Click and return to the previous page-->
        <!--Ask users where they want to update those changes-->
        <a href="ViewOrder.php"><input type="button" value="Close" name="btnClose" onclick="return checkChanges();return false;"></a>
        <!--Ask for confirmation with alert message before updating the table-->
        <!--Send message to users if information is updated-->
        <input type="button" value="Update Order" name="btnUpdate" onclick="return checkDeliveryInfo();return false;">
    </div>
</div>
<?php
mysqli_close($conn);
?>
</body></html>