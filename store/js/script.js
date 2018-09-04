function popupOver(element) {
    document.getElementById("popup").style.visibility = "visible";
}

function popupOut(element) {
    document.getElementById("popup").style.visibility = "hidden";
}

function selectImage(clickedElement) {
    var primary = document.getElementById("image-primary").src;
    var image = clickedElement.getAttribute("src");

    document.getElementById("image-primary").src = image;
    clickedElement.src = primary;
}

function productOnClick(clickedElement) {
    var productId = clickedElement.getAttribute("class");
    window.location.href = "/product.php/" + productId; 
}

function shopOnClick(clickedElement) {
    var shopName = clickedElement.getAttribute("class");
    window.location.href = "shop.php/" + shopName; 
}

function addProductToCart(clickedElement) {
    var productId = clickedElement.getAttribute("id");
    var productQuantity = document.getElementById("product_quantity").value;
    window.location.href = "../add_to_cart.php/" + productId + "*" + productQuantity;
}

function removeProduct(clickedElement) {
    var productId = clickedElement.getAttribute("id");
    var productQuantity = document.getElementById("qty" + productId).innerHTML;
    window.location.href = "remove_from_cart.php/" + productId + "*" + productQuantity; 
}

function rateProduct(clickedElement) {
    var elementId = clickedElement.getAttribute("for");
    var productId = document.getElementById(elementId).getAttribute("class");
    var productRating = document.getElementById(elementId).getAttribute("value");
    window.location.href = "../rate_product.php/" + productId + "*" + productRating;
}

function zoomImage(clickedElement) {
    var image = clickedElement.getAttribute("src");
    var win = window.open(image, '_blank');
    win.focus();
}