<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<style type="text/css">
.error{
  color: red;
}
	body{
    display: flex;
    flex-wrap: wrap;
     justify-content: center;
}
 .inputFieldPadding{
	margin: 20px;
 }
</style>
<body>

<?php 
  $username = $password = "";
  $usernameErr = $passwordErr = "";


  if (isset($_POST['username'])) {
    $username = $_POST['username'];
  	if (strlen($_POST['username']) >= 2) {
  		if (preg_match("^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$^", $_POST['username']) == 1) {
  			$usernameErr = "";

  		}else{
  			$usernameErr = 'User Name can contain alpha numeric characters, period, dash or
underscore only';
  		}
  	}else{
  		$usernameErr = 'Username must contain at least 2 characters!';
  	}
  }

  if (isset($_POST['password'])) {
    $password = $_POST['password'];
  	if (strlen($_POST['password']) >= 8) {
  		if (preg_match("^(?=.*[A-Za-z])(?=.*)(?=.*[@$!%*#?&])[A-Za-z@$%#]^", $_POST['password']) == 1) {
  			$passwordErr = "";

  		}else{
  			$passwordErr = ". Password must contain at least one of the special characters (@, #, $,
%)";
  		}
  	}else{
          $passwordErr = "Password must be at least 8 character!";
  	}
  }



 ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	 <fieldset>
    <legend><h3>NAME</h3></legend>
   
   <div class="inputFieldPadding">
   	<label for="username">User Name :</label>
    <input type="text" name="username" value="<?php echo $username?>"><br>
    <span class="error"><?php echo $usernameErr;?></span><br>
   </div>
    
    <div class="inputFieldPadding">
    <label for="password">Password :</label>
    <input type="password" name="password" value="<?php echo $password?>"><br>
    <span class="error"><?php echo $passwordErr;?></span><br>
    </div>
    <hr>
    <input type="Submit" value="Submit" style="margin-top: 20px">
  </fieldset>
</form>
</body>
</html>