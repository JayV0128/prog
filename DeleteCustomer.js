// check email format
function checkEmail() {
    var emailRegex = /[A-Z0-9a-z]+@[A-Z0-9a-z]+/;
    var searchCust = document.getElementById("searchcustomer");
    var errorMsg = document.querySelector(".showError");

    if (searchCust.value.match(emailRegex) == null) {
        errorMsg.innerHTML = "Please enter valid email.";
        errorMsg.style.color = "red";
    } else {
        errorMsg.innerHTML = "";
    }
}