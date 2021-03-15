<html>
<head>
    <title>Login</title>
    <style>
        html {
            overflow-y: scroll;
        }

        .rounded-input-field {
            border-radius: 15px;
            border: transparent;
            background-color: #eeeeee;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .input-field-margin {
            margin: 6px;
        }

        .content {
            margin: auto;
            text-align: center;
            padding: 20px;

        }

        .sign-in {
            padding: 30px;
            margin: 20px auto auto;
            width: fit-content;
            border-radius: 15px;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .checkbox-style {
            font-weight: bold;
        }

        body {
            overflow: scroll;
            background-image: url("img/valorant.jpg");
            background-size: cover;
        }

        .rectangular-button {
            border-radius: 15px;
            border: transparent;
            color: white;
            padding: 10px 15px 10px 15px;
            background-color: dodgerblue;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            elevation: 8deg;
        }

        .action-button-margin{
            margin: 30px;
        }

        .error{
            color: red;
        }
    </style>
</head>
<body>
<?php
include "header.php";
$userPassword = "123456";
$isAllInputOK = false;
$email = $password = "";
if (isset($_COOKIE['email'])){
    $email = $_COOKIE['email'];
}
$emailErr = $passwordErr = null;


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    else{
        $isAllInputOK = true;
    }
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if (strlen($_POST['password']) >= 8) {
        if (preg_match("^(?=.*[A-Za-z])(?=.*)(?=.*[@$!%*#?&])[A-Za-z@$%#]^", $_POST['password']) == 1) {
            $passwordErr = "";
           if ($userPassword == $password){
               $isAllInputOK = true;
           }else{
               $isAllInputOK = false;
               $passwordErr = "Password do not match";
           }
        }else{
            $passwordErr = ". Password must contain at least one of the special characters (@, #, $,
%)";
            $isAllInputOK = false;
        }
    }else{
        $passwordErr = "Password must be at least 8 character!";
        $isAllInputOK = false;
    }
}

if (isset($_POST['rememberMe'])){
    setcookie("email", $email);
}

if ($isAllInputOK == true){
 header('Location: ProfilePicture.php');
}
?>

<form method="post" action="<?php echo htmlspecialchars(@$_SERVER['PHP_SELF']);?>">
    <div class="content">
        <div class="sign-in">
            <h2>Sign In</h2>
            <div class="input-field-margin">
                <input class="rounded-input-field " type="text" name="email" value="<?php echo $email?>" placeholder="Your Email"><br>
                <p class="error"><?php echo $emailErr?></p><br>
            </div>
           <div class="input-field-margin">
               <input class="rounded-input-field " type="password" name="password" value="<?php echo $password?>" placeholder="Password"><br>
               <p class="error"><?php echo $passwordErr?></p><br>
           </div>
            <input class="input-field-margin checkbox-style" type="checkbox" name="rememberMe"><span class="checkbox-style">Remember Me</span><br>
            <input class="rectangular-button input-field-margin" type="submit" name="submit" value="Login"><br>
            <a href="ForgetPassword.php" class="action-button-margin">Forget Password?</a>
        </div>
    </div>
</form>
<?php include "footer.php" ?>
</body>

</html>
