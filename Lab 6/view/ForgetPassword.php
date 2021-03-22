<html>
<head>
    <title>Forget Password</title>
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
            margin: 10px;
        }

        .content {
            margin: auto;
            text-align: center;
            padding: 20px;

        }

        .rounded-form {
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
        .error{
            color: red;
        }

    </style>
</head>
<body>
<?php
include "header.php";

$email = $emailErr = "";

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
}
?>
<form action="<?php echo htmlspecialchars(@$_SERVER['PHP_SELF']);?>">
    <div class="content">
        <div class="rounded-form">
            <h2>Forget Password</h2>
            <input class="rounded-input-field input-field-margin" type="text" name="email" value="<?php echo $email;?>" placeholder="Your Email"><br>
            <p class="error"><?php echo $emailErr?></p><br>
            <input class="rectangular-button input-field-margin" type="submit" name="submit" value="Submit"><br>
        </div>
    </div>
</form>
<?php include "footer.php" ?>
</body>

</html>
