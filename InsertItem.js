var count = 0;

// change the color and the "on"/"off" mode of the button
function insertMode() {
    var insertItem = document.getElementById("insertItem");
    var btn = document.getElementById("btn");
    var btnInsert = document.getElementById("insertItemMode");
    var mode = ["Insert Item: On", "Insert Item: Off"];
    var type = ["inline-block", "none"];
    var color = ["greenyellow", "pink"];

    count = (count + 1) % 2;
    btnInsert.value = mode[count];
    btnInsert.style.backgroundColor = color[count];
    insertItem.style.display = type[count];
    btn.style.display = type[count];
}

//check item ID format when searching
function checkItemID() {
    var searchItem = document.getElementById("itemID");
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
function checkItemInfo() {
    var itemName = document.getElementById("itemName");
    var itemDesc = document.getElementById("itemDesc");
    var stockQuantity = document.getElementById("stockQuantity");
    var price = document.getElementById("price");
    var form = document.getElementById("insertForm");

    if (itemName.value != "" && itemDesc.value != "" && parseInt(stockQuantity.value) > 0 && price.value != "") {
        if (parseInt(price.value) > 0) {
            alert(`An item is inserted.`);
            form.submit();
            return true;
        } else {
            alert(`You have to input a positive amount for item price.`);
            return false;
        }
    } else {
        if (itemName.value == "" && itemDesc.value == "" && stockQuantity.value == "" && price.value == "") {
            alert(`You have to fill in all fields to insert an item.`);
            return false;
        } else if (itemName.value == "") {
            alert(`You have to fill in the item name to insert an item.`);
            return false;
        } else if (itemDesc.value == "") {
            alert(`You have to fill in the item description to insert an item.`);
            return false;
        } else if (parseInt(stockQuantity.value) == 0) {
            alert(`You have to fill in the stock quantity to insert an item.`);
            return false;
        } else if (parseInt(stockQuantity.value) < 0) {
            alert(`You have to input a positive number for stock quantity.`);
            return false;
        } else {
            alert(`You have to fill in the item price to insert an item.`);
            return false;
        }
    }
}

function resetFields() {
    var itemID = document.getElementById("itemID");
    var itemName = document.getElementById("itemName");
    var itemDesc = document.getElementById("itemDesc");
    var stockQuantity = document.getElementById("stockQuantity");
    var price = document.getElementById("price");

    itemID.value = "";
    itemName.value = "";
    itemDesc.value = "";
    stockQuantity.value = 0;
    price.value = "";
}

// function askConfirm() {
//     var itemID = document.getElementById("iid");
//     var itemName = document.getElementById("iname");
//     var text = `Do you really want to delete the following item?
//         \nItem ID: ${itemID.innerHTML}
//         \nItem Name: ${itemName.innerHTML}`;
//
//     if (confirm(text) == true) {
//         alert(`Item ${itemName.innerHTML} is deleted.`);
//     } else {
//         alert(`You have cancelled the deletion.`);
//     }
// }