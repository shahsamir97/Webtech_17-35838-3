<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
  *{
    box-sizing: border-box;
}
  body{
    display: flex;
    flex-wrap: wrap;
     justify-content: center;
}
</style>
</head>
<body>  

<?php
$nameErr = $emailErr = $genderErr = $dobErr = $degreeErr  = $bloodGroupErr = "";
$name = $email = $gender = $degree = $dob = $bloodGroup = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["dob"])) {
    $dobErr = "Cannot be empty";
  } else {
     $dob =  $_POST["dob"];
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }


  if($_POST["bloodGroup"] == "select"){
    $bloodGroupErr = "Please select a blood group";
  }else{
    $bloodGroup = $_POST['bloodGroup'];
  }
  
   

   if(!empty($_POST["degree"] && $_POST["degree"] != null)){
        if(count($_POST["degree"]) < 2){
         $degreeErr =  "You have to select at least 2 degrees";
      }else{
      $degree = $_POST["degree"];
    }
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>


<form style="border: 3px solid black; padding: 50px; border-radius: 15px"
 method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<fieldset>
<legend><h3>Registration</h3></legend>
<p><span class="error">* required fields</span></p><br>
  <fieldset>
    <legend><h3>NAME</h3></legend>
    <span class="error">* <?php echo $nameErr;?></span><br>
    <input type="text" name="name">
  </fieldset>

  <fieldset>
    <legend><h3>EMAIL</h3></legend>
    <span class="error">* <?php echo $emailErr;?></span><br>
    <input type="text" name="email">
  </fieldset>

  <fieldset>
    <legend><h3>DATE OF BIRTH</h3></legend>
    <span class="error">* <?php echo $dobErr;?></span><br>
    <input type="date" name="dob">
  </fieldset>

  <fieldset>
    <legend><h3>Gender</h3></legend>
    <span class="error">* <?php echo $genderErr;?></span><br>
    <input type="radio" name="gender" value="Female">Female
    <input type="radio" name="gender" value="male">Male
    <input type="radio" name="gender" value="other">Other
  </fieldset>

  <input type="Submit" value="Submit" style="margin-top: 20px">
  <input type="reset" value="Reset" style="margin-top: 20px">
  </fieldset>

<?php

echo "<h2>Your Input:</h2><br>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $dob;
echo "<br>";
echo $gender;
echo "<br>";
echo "Degrees :";
 foreach($_POST["degree"] as $selected){
      echo "$selected <br>";
         }
echo "<br>";
echo $bloodGroup;

?>

</form><br>



</body>
</html>