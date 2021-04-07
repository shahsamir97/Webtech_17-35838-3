var pNameOk = false;
var pDetailsOk = false;
var pPriceOk = false;

function verifyName(){
    var name = document.getElementById("productName").value
    var nameErr = document.getElementById("productNameErr")
    if (name == ""){
        nameOk = false;
        nameErr.innerText = "Name cannot be empty!"
    }else {
        nameOk = true
        nameErr.innerText = null
    }
}

function verifyDetails(){
    var productDetails = document.getElementById("productDetails").value
    var productDetailsErr = document.getElementById("productDetailsErr")
    if (productDetails == ""){
        pDetailsOk = false;
        productDetailsErr.innerText = "Details cannot be empty!"
    }else {
        pDetailsOk = true
        productDetailsErr.innerText = null
    }
}

function verifyPrice(){
    var pPrice = document.getElementById("pPrice").value
    var pPriceErr = document.getElementById("pPriceErr")
        if (pPrice <= 0){
            pPriceOk = false;
            pPriceErr.innerText = "Price cannot be empty or 0 or any negative number!"
        }else{
            pPriceOk = true
            pPriceErr.innerText = null
        }
}

function validateForm(){
    if (pNameOk && pDetailsOk && pPriceOk){
        return true
    }else{
        verifyName()
        verifyDetails()
        verifyPrice()
         pNameOk = false;
         pDetailsOk = false;
         pPriceOk = false;
        return  false;
    }
}

