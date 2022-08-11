<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Order - Salesperson</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <link rel="stylesheet" href="ViewOrder.css">
    <link rel="stylesheet" href="DeleteCustomer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="ViewOrder.js"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Better Limited - Viewing Orders</h1>
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
        <a href="PlaceOrder.php"><input type="button" name="customer" id="customer" value="NewOrder"></a>
        <a href="index1.php"><input type="button" name="logout" id="logout" value="Log out"></a>
    </div>
    <div class="vieworder">
        <form action="ViewOrder.php" method="post">
            Search for Order:
            <input type="text" name="custEmail" id="custEmail" placeholder="Enter Customer Email" onchange="checkEmail();">
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
            <!--check email format and show error message if it is invalid-->
            <span class="showError"></span>
            Choose:
            <input list="sorting" name="sort" id="sort">
            <datalist id="sorting">
                <option value="orderID"></option>
                <option value="dateTime"></option>
                <option value="customerEmail"></option>
            </datalist>
            <input type="radio" name="ordering" value="ASC"> Ascending
            <input type="radio" name="ordering" value="DESC"> Descending
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
            <input type="button" name="deleteOrderMode" id="deleteOrderMode" value="Delete Order: Off" onclick="deleteMode();">
        </form>
    </div>
    <!--Suppose login as s0001, only related orders will be shown-->
    <div class="orderlist">
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Customer Email</th>
                <th>Order Date &amp; Time</th>
                <th>Total Amount ($)</th>
                <th></th>
            </tr>
            <!--Get orders from database-->
            <!--Smaple Data-->
            <?php
            require_once('conn.php');
            extract($_POST);
            // var_dump($_POST);
            if (!empty($custEmail) && empty($sort) && empty($ordering)) {
                $sql = "SELECT orderID, customerEmail, dateTime, orderAmount FROM orders WHERE customerEmail='$custEmail'";
            } else {
                if (!empty($sort) && !empty($ordering)) {
                    $sql = "SELECT orderID, customerEmail, dateTime, orderAmount FROM orders ORDER BY $sort $ordering";
                } else
                    $sql = "SELECT orderID, customerEmail, dateTime, orderAmount FROM orders";
            }

            $rs = mysqli_query($conn, $sql);
            while ($rc = mysqli_fetch_assoc($rs)) {
                extract($rc);
//                var_dump($rc);
                printf('<tr>
                                   <td>%s</td>
                                   <td>%s</td>
                                   <td>%s</td>
                                   <td>%s</td>
                                   <td>
                                      <form method="post" action="viewOrderAction.php">
                                          <button name="btnUpdateOrder">View</button>
                                          <button name="btnDelete" id="btnDelete">Delete</button>
                                          <input type="hidden" name="orderID" value="%s">
                                      </form>
                                   </td>
                                 </tr>', $orderID, $customerEmail, $dateTime, $orderAmount, $orderID);
            }
            mysqli_close($conn);
            ?>

        </table>
    </div>
</div>
</body></html>
