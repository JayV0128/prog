<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Customer - Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <link rel="stylesheet" href="DeleteCustomer.css">
    <script src="DeleteCustomer.js"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Better Limited - Customer</h1>
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
    <div class="viewcustomer">
        <form id="cust" action="DeleteCustomer.php" method="post">
            <!--enter customer email to search in database to obtain the corresponding record-->
            Search for Customer:
            <input type="text" name="searchcustomer" id="searchcustomer" placeholder="Enter Customer's Email" onchange="checkEmail();">
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
            <span class="showError"></span>
            Sort By:
            <input list="para" name="ordering" id="ordering">
            <datalist id="para">
                <option value="customerName"></option>
                <option value="phoneNumber"></option>
            </datalist>
            <input type="radio" name="sort" id="asc" value="ASC"> Ascending
            <input type="radio" name="sort" id="desc" value="DESC"> Descending
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
        </form>
    </div>
    <div class="customerlist">
        <table border="1">
            <tr>
                <th class="cname">Customer Name</th>
                <th class="email">Email Address</th>
                <th class="phone">Phone Number</th>
                <th></th>
            </tr>
            <!--Call database to obtain customers' details-->
            <!--Sample Data-->
            <?php
                require_once('conn.php');
                extract($_POST);
                // var_dump($_POST);

                if (!empty($searchcustomer) && empty($ordering)) {
                    $sql = "SELECT * FROM Customer WHERE customerEmail='$searchcustomer'";
                } else {
                    if (!empty($ordering) && !empty($sort)) {
                        $sql = "SELECT * FROM Customer ORDER BY $ordering $sort";
                    } else
                        $sql = "SELECT * FROM Customer";
                }

                $rs = mysqli_query($conn, $sql);
                while ($rc = mysqli_fetch_assoc($rs)) {
                    extract($rc);
                    printf('<tr>
                                     <td>%s</td>
                                     <td>%s</td>
                                     <td>%s</td>
                                     <td>
                                        <form method="post" action="delete.php">
                                            <button name="btnDelete" type="submit">Delete</button>
                                            <input type="hidden" name="cemail" value="%s">
                                        </form>
                                     </td>
                                   <tr>', $customerName, $customerEmail, $phoneNumber, $customerEmail);
                    }
                    mysqli_close($conn);
                ?>
        </table>
    </div>
</div>
</body></html>
