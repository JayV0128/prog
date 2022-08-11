// check the input fields before the form is submitted for updating the records
function checkItemDetails() {
    var itemName = document.getElementById("itemName");
    var itemDesc = document.getElementById("itemDesc");
    var stockQty = document.getElementById("stockQuantity");
    var price = document.getElementById("price");
    var form = document.getElementById("editForm");

    if (itemName.value != "" && itemDesc.value != "" && parseInt(stockQty.value) > 0 && price.value != "") {
        if (parseInt(price.value) > 0) {
            alert(`An item is edited.`);
            form.submit();
            return true;
        } else {
            alert(`You have to input a positive amount for item price.`);
            return false;
        }
    } else {
        if (itemName.value == "") {
            alert(`You have to fill in the item name.`);
            return false;
        } else if (itemDesc.value == "") {
            alert(`You have to fill in the item description to insert an item.`);
            return false;
        } else if (parseInt(stockQty.value) == 0) {
            alert(`You have to fill in the stock quantity to insert an item.`);
            return false;
        } else if (parseInt(stockQty.value) < 0) {
            alert(`You have to input a positive number for stock quantity .`);
            return false;
        } else {
            alert(`You have to fill in the item price to insert an item.`);
            return false;
        }
    }
}