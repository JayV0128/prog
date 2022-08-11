<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu - Salesperson</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <link rel="stylesheet" href="menuManager.css">
    <script src="menuSalesperson.js"></script>
</head>

<body onload="displayCurrentTime()">
<div class="container">
    <div class="header">
        <h1>Better Limited - Manager Menu</h1>
    </div>
    <div class="loginInfo">
        <?php
            session_start();
            $staffName = $_SESSION['staffName'];
        ?>
        <!--Obtain staff name from database to change the value in welcome message-->
        <input type="text" name="welSname" id="welSname" readonly value="Welcome back, <?php echo $staffName?>!">
        <a href="index1.php"><input type="button" name="logout" id="logout" value="Log out"></a>
    </div>
    <div class="time" id="time"></div>
    <div class="notice"><img src="icon.png"></div>
    <div class="functions">
        <div class="insertItem">
            <a href="InsertItem.php">
                <img src="insert_icon.png">
                <div>Click to insert item</div>
            </a>
        </div>
        <div class="deleteCustomer">
            <a href="DeleteCustomer.php">
                <img src="delete_icon.png">
                <div>Click to delete customer</div>
            </a>
        </div>
        <div class="generateReport">
            <a href="GenerateReport.php">
                <img src="generate_icon.png">
                <div>Click to generate staff reports</div>
            </a>
        </div>
    </div>
</div>
</body></html>