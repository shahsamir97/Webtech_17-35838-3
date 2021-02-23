<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
</head>
<style type="text/css">
  .error {
    color: red;
  }

  body {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .inputFieldPadding {
    margin: 20px;
  }
</style>

<body>


  <?php

  $savedCurrentPassword = "pass123";
   $currentPassword = $newPassword = $confirmPassword = $message =  "";
  $newPasswordErr = $confirmPasswordErr = $currentPasswordErr = "";


  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['currentPassword'])) {
      $currentPassword = $_POST['currentPassword'];

      if ($_POST['currentPassword'] != $savedCurrentPassword) {
        $currentPasswordErr = "Current password do not match!";
      }
    }

    if (isset($_POST['newPassword'])) {
      $newPassword = $_POST['newPassword'];

      if ($_POST['newPassword'] == $currentPassword) {
        $newPasswordErr = "New password should be different from current password";
      }
      if (strlen($_POST['newPassword']) >= 8) {
        if (preg_match("^(?=.*[A-Za-z])(?=.*)(?=.*[@$!%*#?&])[A-Za-z@$%#]^", $_POST['newPassword']) == 1) {
          $newPasswordErr = "";

          if (isset($_POST['confirmPassword']) && isset($_POST['newPassword'])) {
            $confirmPassword = $_POST['confirmPassword'];
            if ($_POST['confirmPassword'] != $_POST['newPassword']) {
              $confirmPasswordErr = "Password do not match! Please write the same password you provided on New Password field";
            }else{
              $message = "Well done! Your password has been changed.";
            }
          }
        } else {
          $newPasswordErr = ". Password must contain at least one of the special characters (@, #, $,%)";
        }
      } else {
        $newPasswordErr = "Password must be at least 8 character!";
      }
    }
  }

  ?>


  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <h2 style="text-align: center;"> Change Password</h2><br><br>
    <fieldset>
      <legend>
        <h3>NAME</h3>
      </legend>

      <div class="inputFieldPadding">
        <label for="currentPassword">Current Password :</label>
        <input type="text" name="currentPassword" value="<?php echo $currentPassword?>"><br>
        <span class="error"><?php echo $currentPasswordErr; ?></span><br>
      </div>

      <div class="inputFieldPadding">
        <label for="newPassword" style="color: green">New Password :</label>
        <input type="text" name="newPassword" value="<?php echo $newPassword?>"><br>
        <span class="error"><?php echo $newPasswordErr; ?></span><br>
      </div>

      <div class="inputFieldPadding">
        <label for="confirmPassword" style="color: red">Confirm Password :</label>
        <input type="text" name="confirmPassword" value="<?php echo $confirmPassword?>"><br>
        <span class="error"><?php echo $confirmPasswordErr; ?></span><br>
      </div>
      <hr>
       <h4><?php echo $message?></h4>
      <input type="Submit" value="Submit" style="margin-top: 20px">
    </fieldset>
  </form>
</body>

</html>