function validateForm() {
    var email = document.getElementById("email").value
    var password = document.getElementById("password").value
    var emailErr = document.getElementById("emailErr")
    var passwordErr = document.getElementById("passwordErr")

    if (email == "" || password == "") {
        emailErr.innerText = "Email cannot be empty!"
        passwordErr.innerText = "Password cannot be empty!"
        return false;
    } else {
        emailErr.innerText = null
        passwordErr.innerText = null
        return true;
    }
}