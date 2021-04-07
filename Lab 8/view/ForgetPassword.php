<html>
<head>
    <title>Forget Password</title>
    <link rel="stylesheet" href="../styles/forget_password.css" type="text/css">
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
