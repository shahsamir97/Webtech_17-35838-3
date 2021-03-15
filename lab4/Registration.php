<html>
<head>
    <title>Registration</title>
    <style>
        html {
            overflow-y: scroll;
        }
        .error{
            color: red;
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
            margin: 10px;
        }

        .content {
            margin: auto;
            text-align: center;
            padding: 50px;
            max-height: 780px;
        }

        .sign-in {
            padding: 30px;
            margin: 20px auto auto;
            width: fit-content;
            border-radius: 15px;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
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

        .drop-down-menu{
            border-radius: 15px;
            border: transparent;
            background-color: #eeeeee;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .action-button-margin{
            margin: 25px;
        }
    </style>

</head>
<body>
<?php
include "header.php";


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

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        if (strlen($_POST['password']) >= 8) {
            if (preg_match("^(?=.*[A-Za-z])(?=.*)(?=.*[@$!%*#?&])[A-Za-z@$%#]^", $_POST['password']) == 1) {
                $passwordErr = "";
                $isAllInputOK = true;
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

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<form method="post" action="<?php echo htmlspecialchars(@$_SERVER['PHP_SELF']); ?>">
    <div class="content" id="reg">
        <div class="sign-in">
            <h2>Registration</h2>
            <input class="rounded-input-field input-field-margin" type="text" name="name" placeholder="Name"><br>
            <input class="rounded-input-field input-field-margin" type="text" name="shopName" placeholder="Shop Name"><br>
            <div  class="input-field-margin rounded-input-field">
                <p style="color: gray">Choose Region</p>
                <select name="region" id="regions" class="drop-down-menu">
                    <option value="bd">Bangladesh</option>
                    <option value="india">India</option>
                    <option value="us">US</option>
                    <option value="us">UK</option>
                </select><br>
            </div>
            <input class="rounded-input-field input-field-margin" type="text" name="email" placeholder="Email"><br><span class="error"><?php echo $emailErr?></span><br>
            <input class="rounded-input-field input-field-margin" type="password" name="password"
                   placeholder="Password"><br><span class="error"><?php echo $emailErr?></span><br>
            <div class="input-field-margin rounded-input-field">
                <p style="color: gray">Gender</p>
                <input type="radio" name="gender" value="Female"> Female
                <input type="radio" name="gender" value="Male"> Male
            </div><br>
            <div class="input-field-margin">
                <p style="font-weight: bold">Date of birth</p>
                <input class="rounded-input-field" type="date" name="dob"><br><span class="error"><?php echo $dobErr?></span><br>
            </div>
            <input class="rectangular-button action-button-margin" type="submit" name="submit" value="Registration">
        </div>
    </div>
</form>
<?php include "footer.php" ?>
</body>
</html>
