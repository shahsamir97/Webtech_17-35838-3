var currentPassOk = false;
var newPassOk = false;
var confirmPassOk = false;

function validateForm(){
    if (currentPassOk && newPassOk && confirmPassOk){
        return true
    }else{
        verifyCurrentPass()
        verifyNewPassword()
        verifyConfirmPassword()
        return false
    }
}

function verifyCurrentPass(){
    var currentPass = document.getElementById("currentPass").value
    var currentPassErr = document.getElementById("currentPasswordErr")
    if (currentPass == ""){
        currentPassOk = false;
        currentPassErr.innerText = "Current password cannot be empty!"
    }else {
        currentPassOk = true;
        currentPassErr.innerText = null
    }
}

function verifyNewPassword(){
    var newPass = document.getElementById("newPass").value
    var newPassErr = document.getElementById("newPasswordErr")
    if (newPass == ""){
        newPassOk = false;
        newPassErr.innerHTML = "Password cannot be empty!"
    }else if(newPass.length <6){
        newPassOk = false;
        newPassErr.innerHTML = "Password must be at least 6 characters!"
    }else{
        newPassOk = true;
        newPassErr.innerText = null;
    }
}

function verifyConfirmPassword(){
    var confirmPass = document.getElementById("confirmPass").value
    var newPass = document.getElementById("newPass").value
    var confirmPassErr = document.getElementById("confirmPasswordErr")
    if (newPass == ""){
        confirmPassOk = false;
        confirmPassErr.innerText = "Type new password first!"
    }else{
        if (confirmPass == ""){
            confirmPassOk = false;
            confirmPassErr.innerText = "Cannot be empty!"
        }else {
            if (confirmPass != newPass){
                confirmPassOk = false;
                confirmPassErr.innerText = "Password do not match!"
            }else{
                confirmPassOk = true;
                confirmPassErr.innerText = null
            }
        }
    }

}