<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Monthly Report - Manager</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <script src="GenerateReport.js"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Better Limited - Staff</h1>
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
    <div class="viewstaff">
        <form id="staff" action="GenerateReport.php" method="post">
            <!--enter staff ID to search in database to obtain the corresponding record-->
            Search for Staff:
            <input type="text" name="searchStaff" id="searchStaff" placeholder="Enter Staff ID" pattern="^[s][0-9]{4}$" onchange="checkStaffID();">
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
            Select Month:
            <input type="month" name="month" id="month">
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
            <span class="showError"></span>
        </form>
    </div>
    <div class="reportlist">
        <table border="1">
            <tr>
                <th class="dt">Date</th>
                <th class="id">Staff ID</th>
                <th class="name">Staff Name</th>
                <th class="numOfOrders">Orders Made</th>
                <th class="amount">Total Sales Amount ($)</th>
            </tr>
            <!--Call database to obtain staffs' details-->
            <!--Sample Data-->
            <?php
            $showDate = false;
            require_once('conn.php');
            extract($_POST);
            // var_dump($_POST);
            if (!empty($searchStaff) && !empty($month)) {
                $sql = "SELECT dateTime, staff.staffID, staffName, COUNT(orders.staffID) AS 'count', SUM(orderAmount) AS 'sum' FROM staff, orders WHERE staff.staffID=orders.staffID AND orders.staffID='$searchStaff' AND dateTime like '$month%'";
            } else {
                if (!empty($month)) {
                    $sql = "SELECT dateTime, staff.staffID, staffName, COUNT(orders.staffID) AS 'count', SUM(orderAmount) AS 'sum' FROM staff, orders WHERE staff.staffID=orders.staffID AND dateTime like '$month%' GROUP BY staff.staffID, staffName";
                } else
                    $sql = "SELECT dateTime, staff.staffID, staffName, COUNT(orderID) AS 'count', SUM(orderAmount) AS 'sum' FROM staff, orders WHERE staff.staffID=orders.staffID GROUP BY staff.staffID, staffName";
            }

            $rs = mysqli_query($conn, $sql);
            while ($rc = mysqli_fetch_assoc($rs)) {
                extract($rc);
                // var_dump($rc);
                if ($count == 0)
                    $sum = 0;
                if ($dateTime == null)
                    $dateTime = $month;
                if($showDate == null)
                    $$dateTime = "";
                printf('<tr>
                                  <td>%s</td>
                                  <td>%s</td>
                                  <td>%s</td>
                                  <td>%s</td>
                                  <td>%s</td>
                               </tr>', $dateTime, $staffID, $staffName, $count, $sum);
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
</div>
</body></html>
