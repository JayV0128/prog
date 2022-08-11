<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Items - Manager</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="GenerateReport.css">
    <link rel="stylesheet" href="InsertItem.css">
    <link rel="stylesheet" href="PlaceOrder.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="InsertItem.js"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Better Limited - Insert Items</h1>
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
    <div class="viewitem">
        <form id="itemfm" action="InsertItem.php" method="post">
            <!--enter item ID to search in database to obtain the corresponding record-->
            Search for Item:
            <input type="text" name="itemID" id="itemID" placeholder="Enter Item ID" pattern="^[0-9]+$" onchange="checkItemID();">
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
            <!--check item ID format and alert error message when it is invalid-->
            <span class="showError"></span>
            Check Item(s) equal or below quantity:
            <input type="text" name="checkQty" min="0" placeholder="Enter number as quantity" pattern="^[0-9]+$">
            <input type="button" name="insertItemMode" id="insertItemMode" value="Insert Item: Off" onclick="insertMode();return false;">
            <button id="btnSearch">
                <x class="fa fa-search"></x>
            </button>
        </form>
    </div>
    <div class="itemlist">
        <table border="1">
            <tr>
                <th class="itemID">Item ID</th>
                <th class="itemName">Item Name</th>
                <th class="stock">Stock Quantity</th>
                <th class="itemPrice">Item Price ($)</th>
                <th></th>
            </tr>
            <!--Call database to obtain items' details "example below"-->
            <?php
            require_once('conn.php');
            extract($_POST);
            // var_dump($_POST);

            if (!empty($itemID) && empty($checkQty)) {
                $sql = "SELECT * FROM Item WHERE itemID=$itemID";
            } else {
                if (!empty($checkQty)) {
                    $sql = "SELECT * FROM Item WHERE stockQuantity<=$checkQty";
                } else
                    $sql = "SELECT * FROM Item";
            }

            $rs = mysqli_query($conn, $sql);
            while ($rc = mysqli_fetch_assoc($rs)) {
                extract($rc);
                printf('<tr>
                                  <td id="iid">%s</td>
                                  <td id="iname">%s</td>
                                  <td>%s</td>
                                  <td>%s</td>
                                  <td>
                                     <form id="Toeditfm" action="action.php" method="post">
                                        <button id="btnEdit" name="btnEdit">Edit Item</button>
                                        <!--Click to delete items with onClick event-->
                                        <button id="btnDelete" name="btnDelete">Delete Item</button>
                                        <input type="hidden" name="id" value="%s">
                                     </form>
                                  </td>
                               </tr>', $itemID, $itemName, $stockQuantity, $price, $itemID);
            }
            ?>
        </table>
    </div>
    <!-- itemID will be generated after the item is created successfully -->
    <div class="insertItem" id="insertItem">
        <form action="AddItem.php" method="post" id="insertForm">
            <div class="leftside">
                <!--generated automatically-->
                <div class="itemname">Item Name: <input type="text" name="itemName" id="itemName" value=""></div>
                <!--set the limited of words to 50 by php-->
                <div class="itemdesc">
                    Item Description:
                    <textarea cols="50" rows="4" id="itemDesc" name="itemDesc" placeholder="Enter Item Description..."></textarea>
                </div>
            </div>
            <div class="rightside">
                <div class="stockquantity">
                    Stock Quantity:
                    <input type="number" name="stockQuantity" id="stockQuantity" value="0" min="0">
                </div>
                <div class="price">Price: $<input type="text" name="price" id="price" value=""></div>
            </div>
        </form>
        <div class="btn" id="btn">
            <button type="reset" onclick="resetFields();">Clear Fields</button>
            <button type="button" onclick="return checkItemInfo();return false;">Create Item</button>
        </div>
    </div>
</div>
<?php
mysqli_close($conn);
?>
</body>
</html>