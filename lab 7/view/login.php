<html>
<head>
    <title>Login</title>
    <link type="text/css" rel="stylesheet" href="../styles/login_page_style.css">
</head>
<body>
<?php
session_start();

include "header.php";

$email = $password = "";
$emailErr = $passwordErr = null;

if (isset($_COOKIE['email'])){
    $email = trim($_COOKIE['email']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['email'])) {
        $email = test_input($_POST['email']);
        if (!empty($email)){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
            else{
                $emailErr = false;
            }
        }else{
            $emailErr = "Cannot be empty";
        }

    }

    if (isset($_POST['password'])) {
        $password = test_input($_POST['password']);
        if (empty($password)){
            $passwordErr = "Password cannot be empty";
        }else{
            if (strlen($_POST['password']) < 6) {
                $passwordErr = "Password must be at least 6 character!";
            }
        }
    }

    if (!$emailErr && !$passwordErr){
        require $_SERVER['DOCUMENT_ROOT']."/controller/login_controller.php";
        $userID = signIn($email, $password);
        if($userID != null){
            $_SESSION['userId'] = $userID;
            $_SESSION['email'] = $email;
            header('Location: seller_profile.php');
        }else{
            echo "<script>alert('Wrong Credentials. Couldn\'t Sign In!')</script>";
        }
    }
}

if (isset($_POST['rememberMe'])){
    setcookie("email", $email);
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

<form method="post" action="<?php echo htmlspecialchars(@$_SERVER['PHP_SELF']); ?>">
    <div class="content">
        <div class="rounded-form">
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
