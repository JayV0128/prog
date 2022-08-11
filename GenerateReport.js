function checkStaffID() {
    var searchStaff = document.getElementById("searchStaff");
    var errorMsg = document.querySelector(".showError");
    var staffIDRegex = /^s[0-9]{4}$/;

    if (searchStaff.value.match(staffIDRegex) == null) {
        errorMsg.innerHTML = "Please enter valid staff ID.";
        errorMsg.style.color = "red";
    } else {
        errorMsg.innerHTML = "";
    }
}