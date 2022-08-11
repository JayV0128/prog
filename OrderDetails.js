// remind the users if they click close before updating the record
function checkChanges() {
    var deliveryAddress = document.getElementById("deliveryAddress");
    var deliveryDate = document.getElementById("deliveryDate");
    var text = `Do you really want to exit? \nChanges would not be saved.`;

    if (deliveryAddress.value != "" || deliveryDate.value != "") {
        if (confirm(text) == false) {
            alert(`Remember to click "Update" before you leave.`);
            return false;
        }
    }
}

// check input fields before the form is submitted
function checkDeliveryInfo() {
    var address = document.getElementById("deliveryAddress");
    var date = document.getElementById("deliveryDate");
    var form = document.getElementById("orderform");
    var regex = /([12]\d{3}(\/|-)(0[1-9]|1[0-2])(\/|-)(0[1-9]|[12]\d|3[01]))/;

    // check if the fields are not null
    if (date.value != "" && address.value != "") {
        if (date.value.match(regex) != null) {
            alert(`Delivery Address & Date are updated.`);
            form.submit();
            return true;
        } else {
            alert(`Invalid date format, Please fill in again.`);
            date.style.borderColor = "red";
            return false;
        }
    } else if (address.value == "" && date.value == "") {
        alert(`You have to fill in the delivery address and date.`);
        address.style.borderColor = "red";
        date.style.borderColor = "red";
        return false;
    } else if (address.value == "") {
        alert(`You have to fill in the delivery address.`);
        address.style.borderColor = "red";
        date.style.borderColor = "black";
        return false;
    } else {
        alert(`You have to fill in the delivery date.`);
        date.style.borderColor = "red";
        address.style.borderColor = "black";
        return false;
    }
}