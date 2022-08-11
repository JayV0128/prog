// click the icon to show password
function showPassword() {
    var pswd = document.getElementById("spswd");
    var type = pswd.getAttribute("type") === "password" ? "text" : "password";

    pswd.setAttribute("type", type);
}

// check the staff name and the password is not empty after clicking login button
function checkFields() {
    var sid = document.getElementById("sid");
    var pswd = document.getElementById("spswd");
    var form = document.getElementById("loginfm");

    if (sid.value == "" && pswd.value == "") {
        alert(`You have to enter your staff ID and password.`);
        pswd.style.borderColor = "red";
        sid.style.borderColor = "red";
        return false;
    } else if (sid.value == "") {
        alert(`You have to enter your name.`);
        sid.style.borderColor = "red";
        pswd.style.borderColor = "#bb9ff4";
        return false;
    } else if (pswd.value == "") {
        alert(`You have to enter your password.`);
        sid.style.borderColor = "#bb9ff4";
        pswd.style.borderColor = "red";
        return false;
    } else {
        sid.style.borderColor = "#bb9ff4";
        return true;
    }
}
