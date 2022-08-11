var count = 0;

// changes color and the "on"/"off" mode of the button
function createMode() {
    var createOrder = document.getElementById("createOrder");
    var btn = document.getElementById("btn");
    var btnCreate = document.getElementById("createOrderMode");
    var mode = ["Create Order: On", "Create Order: Off"];
    var type = ["inline-block", "none"];
    var color = ["greenyellow", "pink"];

    count = (count + 1) % 2;
    btnCreate.value = mode[count];
    btnCreate.style.backgroundColor = color[count];
    createOrder.style.display = type[count];
    btn.style.display = type[count];
}


function checkItem() {
    var searchItem = document.getElementById("id");
    var errorMsg = document.querySelector(".showError");
    var itemIDRegex = /^[0-9]+$/;

    if (searchItem.value.match(itemIDRegex) == null || searchItem.value == 0) {
        errorMsg.innerHTML = "Please enter valid item ID.";
        errorMsg.style.color = "red";
    } else {
        errorMsg.innerHTML = "";
    }
}

// check the input fields before the form is submitted
function checkOrderInfo() {
    var staffID = document.getElementById("staffID");
    var itemID = document.getElementById("itemID");
    var cEmail = document.getElementById("custEmail");
    var dAddress = document.getElementById("deliveryAddress");
    var dDate = document.getElementById("deliveryDate");
    var form = document.getElementById("createform");
    var dateRegex = /([12]\d{3}(\/|-)(0[1-9]|1[0-2])(\/|-)(0[1-9]|[12]\d|3[01]))/;
    var emailRegex = /[A-Z0-9a-z]+@[A-Z0-9a-z]+/;

    // check if the fields are not null
    if (staffID.value != "" && itemID.value != "" && cEmail.value != "" && dAddress.value != "" && dDate.value != "") {
        if ((dDate.value.match(dateRegex) != null) && (cEmail.value.match(emailRegex) != null)) {
            alert(`Order is created.`);
            form.submit();
            return true;
        } else if (dDate.value.match(dateRegex) == null) {
            alert(`Invalid date format, Please fill in again.`);
            return false;
        } else {
            alert(`Invalid email format, Please fill in again.`);
            return false;
        }
    } else {
        // check if the fields are null
        if (staffID.value == "" && itemID.value == "" && cEmail.value == "" && dAddress.value == "" && dDate.value == "") {
            alert(`You have to fill in all fields to create an order.`);
            return false;
        } else if (staffID.value == "") {
            alert(`You have to fill in the staff ID to create an order.`);
            return false;
        } else if (itemID.value == "") {
            alert(`You have to fill in the item ID to create an order.`);
            return false;
        } else if (dAddress.value == "") {
            alert(`You have to fill in the delivery address to create an order.`);
            return false;
        }
    }
}

function resetFields() {
    var cEmail = document.getElementById("custEmail");
    var dAddress = document.getElementById("deliveryAddress");
    var dDate = document.getElementById("deliveryDate");

    cEmail.value = "";
    dAddress.value = "";
    dDate.value = "";
}