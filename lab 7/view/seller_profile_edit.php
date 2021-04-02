<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../styles/seller_profileEdit_style.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: ../view/seller_profile.php');
}
include "header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/controller/seller_profile_controller.php";


$nameErr = $shopNameErr = $phoneErr = $emailErr = $dobErr = $regionErr = "";
$name = $shopName = $email = $previousEmail = $phone = $dob = $region = "";
$imagePath = null;

//Profile picture change
$message = "";
$imagePath = getProfilePicture($_SESSION['userId']);
if ($imagePath == null){
    $imagePath = "../img/avatar_icon.png";
}

$target_dir = "../storage/seller_profile_pictures/";

$product = getUserInfo($_SESSION['userId'])[0];
if ($userInfo != null) {
    $name = $userInfo['name'];
    $shopName = $userInfo['shopName'];
    $email = $userInfo['email'];
    $previousEmail = $userInfo['email'];
    $phone = $userInfo['phone'];
    $dob = $userInfo['dob'];
    $region = $userInfo['region'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["profilePictureUpload"])) {
        $temp = explode(".", $_FILES["profilePictureUpload"]["name"]);
        $newFilename = $target_dir . $_SESSION['userId'] . '.' . end($temp);
        $message = "working";
        $target_file = $target_dir . basename($_FILES["profilePictureUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $message = "checking file type";
            $message = "Sorry, only JPG, JPEG & PNG files are allowed.";
            $uploadOk = 0;
        } else {
            if (file_exists($target_file)) {
                unlink($newFilename);
                $message = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            if ($_FILES["profilePictureUpload"]["size"] > 4194304) {
                $message = "checking file size";
                $message = "Sorry, your file is too large. <br> Picture size should not be more than 4MB";
                $uploadOk = 0;
            } else {
                echo
                $uploadOk = 1;
            }

        }

        if ($uploadOk == 1) {
            $message = "File successfully uploaded";
            if (move_uploaded_file($_FILES["profilePictureUpload"]["tmp_name"], $newFilename)) {
                $message = "The file " . htmlspecialchars(basename($_FILES["profilePictureUpload"]["name"])) . " has been uploaded.";
                $imagePath = $newFilename;
                echo $imagePath;
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    }

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

    if (isset($_POST['phone'])) {
        $phone = test_input($_POST['phone']);
        if (empty($phone)) {
            $phoneErr = "Cannot be empty";
        } else {
            if (preg_match("^\+?\d*$^", $phone) == 1) {
                $phoneErr = false;
            } else {
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

    if (!$nameErr && !$shopNameErr && !$emailErr
        && !$regionErr && !$dobErr) {
        if ($previousEmail == $email) {
            if (applyProfileEdits($_SESSION['userId'], $email, $name, $shopName, $phone, $region, $dob, $imagePath)) {
                 echo "<script>alert('Successfully registered. Now you can login')</script>";
            } else {
                echo "<script>alert('Couldn\'t register! Something went wrong. Try again')</script>";
            }
        } else {
            if (doesEmailAlreadyExist($email)) {
                $emailErr = "This email is already taken";
            } else {
                if (applyProfileEdits($_SESSION['userId'], $email, $name, $shopName, $phone, $region, $dob, $imagePath)) {
                    //echo "<script>alert('Successfully registered. Now you can login')</script>";
                } else {
                    // echo "<script>alert('Couldn\'t register! Something went wrong. Try again')</script>";
                }
            }
        }
    }

}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<form method="post" action="<?php echo htmlspecialchars(@$_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
    <div class="content" id="reg">
        <div class="rounded-form">
            <h2>Edit Profile</h2>
            <div class="profile-picture rounded-input-field">
                <p>Profile Picture</p>
                <img src="<?php echo $imagePath; ?>" alt="Avatar Icon" height="100" width="100"
                     style="align-content: center"><br>
                <input type="file" name="profilePictureUpload" id="profilePictureUpload">
                <p><?php echo $message ?></p>
            </div>
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
                <input class="rounded-input-field input-field-margin" type="text" name="phone"
                       placeholder="Phone(Eg. +8801626...)"
                       value="<?php echo $phone ?>"><br>
                <span class="error"><?php echo $phoneErr; ?></span>
            </div>
            <div class="input-field-margin rounded-input-field">
                <p style="color: gray">Your Country</p>
                <select name="region" id="regions" class="drop-down-menu">
                    <option selected="selected" value="<?php echo $region ?>"><?php echo $region ?></option>
                    <?php
                    include '../utils/utilities.php';
                    $countries = getCountryNames();
                    foreach ($countries as $country) {
                        echo "<option value=" . $country . ">$country</option>";
                    }
                    ?>
                </select><br><span class="error"><?php echo $regionErr ?></span>
            </div>
            <div>
                <input class="rounded-input-field input-field-margin" type="text" name="email" placeholder="Email"
                       value="<?php echo $email ?>"><br>
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div class="input-field-margin">
                <p style="">Date of birth</p>
                <input class="rounded-input-field" type="date" name="dob" value="<?php echo $dob ?>"><br>
                <span class="error"><?php echo $dobErr ?></span><br>
            </div>
            <input class="rectangular-button action-button-margin" type="submit" name="submit" value="Apply Edits">
        </div>
    </div>
</form>
<?php include "footer.php" ?>
</body>
</html>
