<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="index.js"></script>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Better Limited</h1>
        <h3>Welcome Login!!</h3>
    </div>
    <div class="loginform">
        <div class="icon">
            <img src="login.png">
        </div>
        <div class="form">
            <!--onsubmit loginfm to check staffID and staffPswd-->
            <form id="loginfm" action="index1.php" method="post" onsubmit="return checkFields();">
                <div class="staffID">
                    <!--check sid format-->
                    Staff ID: <input type="text" name="sid" id="sid" placeholder="Enter Your Staff ID" pattern="^s[0-9]{4}$">
                </div>
                <div class="staffPswd">
                    Password: <input type="password" name="spswd" id="spswd" placeholder="Enter Your Password">
                    <!--onclick icon to show password hidden-->
                    <button id="showPswd" onclick="showPassword();return false;">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="btn">
                    <button type="submit">Login</button>
                    <button type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
// call database
require_once('conn.php');
// check if the form is submitted
if (!empty($_POST)) {
    extract($_POST);

    $sql = "SELECT * FROM Staff";
    $rs = mysqli_query($conn, $sql);

    while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);

        // check whether the staffID and password is valid or not
        if ($sid == $staffID && $spswd == $password) {
            session_start();
            $_SESSION['staffName'] = array();
            $_SESSION['staffName'] = $staffName;
            $_SESSION['staffID'] = $sid;
            if ($position == "Staff") {
                header("location:menuSalesperson.php");
            }
            else {
                header("location:menuManager.php");
            }
        }
    }
}
mysqli_close($conn);
?>
</body>
</html>

