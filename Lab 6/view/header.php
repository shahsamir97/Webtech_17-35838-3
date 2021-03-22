<html>
<head>
    <style>
        * {box-sizing: border-box;}

        body {
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            overflow: hidden;
            background:white;
            padding: 20px 10px;
        }

        .headerLogo{
            margin-left: 20px;
            height: 60px;
        }

        .header a {
            float: left;
            color: black;
            text-align: center;
            font-weight: bold;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        .header a:hover {
            background-color: #ddd;
            color: black;
        }

        .header a.active {
            background-color: dodgerblue;
            color: white;
        }

        .header-right {
            float: right;
        }

        @media screen and (max-width: 500px) {
            .header a {
                float: none;
                display: block;
                text-align: left;
            }

            .header-right {
                float: none;
            }
        }
    </style>

</head>
<body>
<?php
$loggedIn = "hidden";
$loggedOut = "visible";
if (isset($_SESSION['userId'])){
    $loggedIn = "visible";
    $loggedOut= "hidden";
}
?>

<div class="header">
    <img src="../img/logo.png" alt="company logo" class="headerLogo"/>

    <div class="header-right">
        <div id="logged_in_header" style="visibility:<?php echo $loggedIn?>; display: <?php if(!isset($_SESSION['email'])){echo "none";}else{echo "initial";}?>">
            <a id="userName"">Logged in as <?php if (isset($_SESSION['email']))echo $_SESSION['email']?></a>
            <a href="logout.php">Logout</a>
        </div>
        <div id="logged_out_header" style="visibility:<?php echo $loggedOut?>; display: <?php if (isset($_SESSION['email'])){echo "none";}else{echo "initial";}?>">
            <a  href="HomePage.php">Home</a>
            <a  href=login.php>Login</a>
            <a  href="Registration.php">Registration</a>
        </div>
    </div>
</div>
</body>

</html>
