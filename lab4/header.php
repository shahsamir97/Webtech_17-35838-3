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
            background-color: #f1f1f1;
            padding: 20px 10px;
            height: 100px;
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

<div class="header">
    <img src="img/logo.png" alt="company logo" class="headerLogo"/>
    <div class="header-right">
        <a id='homePage'  href="HomePage.php">Home</a>
        <a id="'loginPage"  href=login.php>Login</a>
        <a id="registrationPage" href="Registration.php">Registration</a>
    </div>
</div>
</body>

</html>
