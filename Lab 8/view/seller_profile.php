<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="../styles/seller_profile_styles.css">
</head>

<body>
<?php
session_start();
include 'header.php';
require $_SERVER['DOCUMENT_ROOT'] . "/controller/seller_profile_controller.php";

if (!isset($_SESSION['userId'])) {
    header('Location: ../view/login.php');
}
//When you upload an Image you can also see the preview when all validation successfully completes.
//The uploaded file will be transfered to Uploads/ folder.
//when you run and test this app to able to see the preview you must have an upload folder created
// in the same directory from where you run the seller_profile.php file.

//User details
$name = $email = $phone = $address = $region = $shopName = "N/A";

$userInfo = getUserInfo($_SESSION['userId'])[0];

$imagePath = getProfilePicture($_SESSION['userId']);

?>
<div class="flex-container">
            <div class="sidenav rounded-input-field">
                <a href="#about">Profile</a><br>
                <a href="../view/add_product.php">Add Product</a><br>
                <a href="#clients">Orders</a><br>
                <a href="#contact">Store Settings</a><br>
                <a href="../view/change_password.php">Change Password</a>
            </div>
          <div class="content rounded-input-field">
            <table class="user-info">
                <tr>
                    <td>Name</td>
                    <td> : <?php echo $userInfo['name']; ?></td>
                </tr>
                <tr>
                    <td>Shop Name</td>
                    <td> : <?php echo $userInfo['shopName']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td> : <?php echo $userInfo['email']; ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td> : <?php echo $userInfo['phone']; ?></td>
                </tr>
                <tr>
                    <td>Region</td>
                    <td> : <?php echo $userInfo['region']; ?></td>
                </tr>
                <tr>
                    <td>Date of birth</td>
                    <td> : <?php echo $userInfo['dob'] ?></td>
                </tr>
            </table>
              <input id="edit_profile" class="rectangular-button" type="button" value="Edit Profile"/>
        </div>

    <div class="profile-picture rounded-input-field">
                <p>Profile Picture</p>
            <img src="<?php echo $imagePath; ?>" alt="Avatar Icon" height="200" width="200"
                 style="align-content: center"><br>
    </div>
</div>
<footer>
    <?php include 'footer.php'; ?>
</footer>

<script type="text/javascript" src="../scripts/profile_view.js"></script>
</body>

</html>