<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu - Salesperson</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <link rel="stylesheet" href="menuSalesperson.css">
    <script src="menuSalesperson.js"></script>
</head>

<body onload="displayCurrentTime()">
<div class="container">
    <div class="header">
        <h1>Better Limited - Salesperson Menu</h1>
    </div>
    <div class="loginInfo">
        <!--Obtain staff name from database to change the value in welcome message-->
        <?php
            session_start();
            $staffName = $_SESSION['staffName'];
        ?>
        <input type="text" name="welSname" id="welSname" readonly value="Welcome back, <?php echo $staffName; ?>!">
        <a href="index1.php"><input type="button" name="logout" id="logout" value="Log out"></a>
    </div>
    <div class="time" id="time"></div>
    <div class="notice"><img src="icon.png" alt=""></div>
    <div class="functions">
        <div class="viewOrder">
            <a href="ViewOrder.php">
                <img src="ViewOrderImage.jpg">
                <div>Click to view order</div>
            </a>
        </div>
        <div class="placeOrder">
            <a href="PlaceOrder.php">
                <img src="PlaceOrderImage.jpg">
                <div>Click to place order</div>
            </a>
        </div>
        <div class="deleteOrder">
            <a href="ViewOrder.php">
                <img src="delete_icon.png">
                <div>Click to delete order</div>
            </a>
        </div>
    </div>
</div>
</body>
</html>