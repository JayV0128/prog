var count = 0;

// changes color and the "on"/"off" mode of the button
function deleteMode() {
    var btnTDel = document.querySelectorAll("#btnDelete");
    var btnDelete = document.getElementById("deleteOrderMode");
    var mode = ["Delete Order: On", "Delete Order: Off"];
    var type = ["inline-block", "none"];
    var color = ["greenyellow", "pink"];

    count = (count + 1) % 2;
    btnDelete.value = mode[count];
    btnDelete.style.backgroundColor = color[count];

    for (var i=0; i<btnTDel.length; i++) {
        btnTDel[i].style.display = type[count];
    }
}

// check email format
function checkEmail() {
    var emailRegex = /[A-Z0-9a-z]+@[A-Z0-9a-z]+/;
    var searchCust = document.getElementById("custEmail");
    var errorMsg = document.querySelector(".showError");

    if (searchCust.value.match(emailRegex) == null) {
        errorMsg.innerHTML = "Please enter valid email.";
        errorMsg.style.color = "red";
    } else {
        errorMsg.innerHTML = "";
    }
}
