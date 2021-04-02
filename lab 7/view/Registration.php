<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet", type="text/css" href="../styles/registration_page_style.css">
</head>
<body>
<?php
include "header.php";
require $_SERVER['DOCUMENT_ROOT']."/controller/registration_controller.php";


$nameErr = $shopNameErr = $phoneErr = $emailErr = $passwordErr = $genderErr = $dobErr = $regionErr = "";
$name = $shopName = $email = $phone = $password = $gender = $dob = $region = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        } else {
            $nameErr = false;
        }
    }

    $shopName = test_input($_POST['shopName']);
    if (empty($shopName)) {
        $shopNameErr = "cannot be empty";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $shopName)) {
            $shopNameErr = "Only letters and white space allowed";
        } else {
            $shopNameErr = false;
        }
    }


    if (isset($_POST['region'])) {
        $region = test_input($_POST['region']);
        $regionErr = false;
    } else {
        $regionErr = "Select a region";
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            $emailErr = false;
        }
    }

    if (isset($_POST['phone'])){
        $phone = test_input($_POST['phone']);
        if (empty($phone)){
            $phoneErr = "Cannot be empty";
        }else{
            if (preg_match("^\+?\d*$^", $phone) == 1){
                $phoneErr = false;
            }else{
                $phoneErr = "Only Number and (+) is allowed";
            }
        }
    }

    if (empty($_POST["dob"])) {
        $dobErr = "Cannot be empty";
    } else {
        $dob = $_POST["dob"];
        $dobErr = false;
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
        $genderErr = false;
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        if (strlen($_POST['password']) >= 6) {
            if (preg_match("^(?=.*[A-Za-z])(?=.*)(?=.*[@$!%*#?&])[A-Za-z@$%#]^", $_POST['password']) == 1) {
                $passwordErr = false;
            } else {
                $passwordErr = "Password must contain at least one number, one letter <br>and one of the special characters (@, #, $,%)";
            }
        } else {
            $passwordErr = "Password must be at least 6 character!";
        }
    }

    if (!$nameErr && !$shopNameErr && !$emailErr && !$passwordErr
        && !$regionErr && !$dobErr) {
        if (doesEmailAlreadyExist($email)){
            $emailErr = "This email is already taken";
        }else{
            if (createUser($email, $password, $name, $shopName, $phone, $region, $dob, $gender)){
                echo "<script>alert('Successfully registered. Now you can login')</script>";
            }else{
                echo "<script>alert('Couldn\'t register! Something went wrong. Try again')</script>";
            }
        }
    }

}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<form method="post" action="<?php echo htmlspecialchars(@$_SERVER['PHP_SELF']); ?>">
    <div class="content" id="reg">
        <div class="rounded-form">
            <h2>Registration</h2>
            <div>
                <input class="rounded-input-field input-field-margin" type="text" name="name" placeholder="Name"
                       value="<?php echo $name ?>"><br>
                <span class="error"><?php echo $nameErr ?></span>
            </div>
            <div>
                <input class="rounded-input-field input-field-margin" type="text" name="shopName"
                       placeholder="Shop Name"
                       value="<?php echo $shopName ?>"><br>
                <span class="error"><?php echo $shopNameErr ?></span>
            </div>
            <div>
                <input class="rounded-input-field input-field-margin" type="text" name="phone" placeholder="Phone(Eg. +8801626...)"
                       value="<?php echo $phone?>"><br>
                <span class="error"><?php echo $phoneErr;?></span>
            </div>
            <div class="input-field-margin rounded-input-field">
                <p style="color: gray">Your Country</p>
                <select name="region" id="regions" class="drop-down-menu">
                    <?php
                    include '../utils/utilities.php';
                    $countries = getCountryNames();
                    foreach ($countries as $country) {
                        echo "<option value=".$country.">$country</option>";
                    }
                    ?>
                </select><br><span class="error"><?php echo $regionErr ?></span>
            </div>
            <div>
                <input class="rounded-input-field input-field-margin" type="text" name="email" placeholder="Email"
                       value="<?php echo $email ?>"><br>
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div>
                <input class="rounded-input-field input-field-margin" type="password" name="password"
                       placeholder="Password" value="<?php echo $password ?>"><br>
                <span class="error"><?php echo $passwordErr ?></span>
            </div>
            <div class="input-field-margin rounded-input-field">
                <p style="color: gray">Gender</p>
                <input type="radio" name="gender" value="Female"> Female
                <input type="radio" name="gender" value="Male"> Male<br>
                <span class="error" style="font-weight: normal; padding: 10px"><?php echo $genderErr ?></span>
            </div>
            <div class="input-field-margin">
                <p style="font-weight: bold">Date of birth</p>
                <input class="rounded-input-field" type="date" name="dob" value="<?php echo $dob?>"><br>
                <span class="error"><?php echo $dobErr ?></span><br>
            </div>
            <input class="rectangular-button action-button-margin" type="submit" name="submit" value="Registration">
        </div>
    </div>
</form>
<?php include "footer.php" ?>
</body>
</html>
