<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="../styles/seller_changePassword_style.css">
    <script type="text/javascript" src="../scripts/change_password.js"></script>
</head>

<body>


<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . "/controller/seller_profile_controller.php";

$savedCurrentPassword = getOldPassword($_SESSION['userId']);
$currentPassword = $newPassword = $confirmPassword = $message = "";
$newPasswordErr = $confirmPasswordErr = $currentPasswordErr = null;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['currentPassword'])) {
        $currentPassword = $_POST['currentPassword'];

        if ($_POST['currentPassword'] != $savedCurrentPassword) {
            $currentPasswordErr = "Current password do not match!";
        } else {
            $currentPasswordErr = "";
        }
    }

    if (isset($_POST['newPassword'])) {
        $newPassword = $_POST['newPassword'];

        if ($_POST['newPassword'] == $currentPassword) {
            $newPasswordErr = "New password should be different from current password";
        }
        if (strlen($_POST['newPassword']) >= 6) {
            if (preg_match("^(?=.*[A-Za-z])(?=.*)(?=.*[@$!%*#?&])[A-Za-z@$%#]^", $_POST['newPassword']) == 1) {
                $newPasswordErr = "";
            } else {
                $newPasswordErr = ". Password must contain at least one of the special characters (@, #, $,%)";
            }
        } else {
            $newPasswordErr = "Password must be at least 8 character!";
        }
    }

    if (isset($_POST['confirmPassword'])) {
        $confirmPassword = $_POST['confirmPassword'];
        if ($_POST['confirmPassword'] != $_POST['newPassword']) {
            $confirmPasswordErr = "Password do not match! Please write the same password you provided on New Password field";
        } else {
            $confirmPasswordErr = "";
        }
    }

    if ($currentPasswordErr == "" && $newPasswordErr == "" && $confirmPasswordErr == "") {
        if (changeUserPassword($_SESSION['userId'], $newPassword)) {
            echo "<script>alert('Password successfully changed')</script>";
            $message = "Well done! Your password has been changed.";
        } else {
            echo "<script>alert('Something went wrong! Couldn\'t change the password. Try again)</script>";
        }
    }else{
        $message = "Oops Couldn't change the password";
    }
}

?>


<form class="rounded-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
    <h2 style="text-align: center;"> Change Password</h2><br><br>

    <input id="currentPass" class="rounded-input-field input-field-margin" placeholder="Current Password"
           type="password" name="currentPassword" value="<?php echo $currentPassword ?>" onblur="verifyCurrentPass()">
    <span id="currentPasswordErr" class="error"><?php echo $currentPasswordErr; ?></span><br>

    <input id="newPass" class="rounded-input-field input-field-margin" placeholder="New Password" type="password"
           name="newPassword" value="<?php echo $newPassword ?>" onblur="verifyNewPassword()">
    <span id="newPasswordErr" class="error"><?php echo $newPasswordErr; ?></span><br>

    <input id="confirmPass" class="rounded-input-field input-field-margin" placeholder="Confirm Password"
           type="password"
           name="confirmPassword" value="<?php echo $confirmPassword ?>" onblur="verifyConfirmPassword()">
    <span id="confirmPasswordErr" class="error"><?php echo $confirmPasswordErr; ?></span><br>

    <input class="rectangular-button" type="Submit" value="Submit" style="margin-top: 20px">
    <input id="backButton" class="outlined-button action-button-margin" value="Back to Profile" type="button">

</form>
<script src="../scripts/seller_change_password.js"></script>
</body>

</html>