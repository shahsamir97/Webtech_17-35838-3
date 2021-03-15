<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
</head>
<style type="text/css">
    * {
        box-sizing: border-box;
    }

    form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        font-weight: bold;
        margin: 30px;
    }

    .inputFieldPadding {
        margin: 20px;
    }
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    .column {
        float: left;
        width: fit-content;
        padding: 20px;
        height: 100%; /* Should be removed. Only for demonstration */
        border: black solid 2px;
    }

    tr{
        padding: 15px;
        margin: 15px;
    }


    .sidenav {
        height: 100%;
        width: 160px;
        position: relative;
        margin: ;
        z-index: 0;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        padding-top: 20px;
    }

    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: white;
        display: block;
    }

    .sidenav a:hover {
        background-color: dodgerblue;
    }

</style>

<body>
    <?php
    include 'header.php';
    //When you upload an Image you can also see the preview when all validation successfully completes.
    //The uploaded file will be transfered to Uploads/ folder.
    //when you run and test this app to able to see the preview you must have an upload folder created
    // in the same directory from where you run the ProfilePicture.php file.

    //User details
    $name  = $email = $phone = $address = $region = $shopName = "N/A";



    //Profile picture change
    $message = "";
    $imagePath ="img/avatar_icon.png";
    $target_dir = "uploads/";
    if(isset($_FILES["profilePictureUpload"]) && isset($_POST["submit"])){
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
                $message = "Sorry, file already exists.";
                $uploadOk = 0;
              }else{
                if ($_FILES["profilePictureUpload"]["size"] > 4194304) {
                    $message = "checking file size";
                    $message = "Sorry, your file is too large. <br> Picture size should not be more than 4MB";
                    $uploadOk = 0;
                }else{
                    $uploadOk = 1;
                }
              }
        }
        if($uploadOk == 1){
            $message = "File successfully uploaded";
            if (move_uploaded_file($_FILES["profilePictureUpload"]["tmp_name"], $target_file)) {
                $message =  "The file ". htmlspecialchars( basename( $_FILES["profilePictureUpload"]["name"])). " has been uploaded.";
                $imagePath ="$target_file";
              } else {
                $message = "Sorry, there was an error uploading your file.";
              }
        }
    }
    ?>
    <script type="text/javascript" src="scripts/profile_view.js"></script>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <div class="row">
            <div class="column" style="background-color: black">
                <div class="sidenav">
                    <a href="#about">Profile</a>
                    <a href="#services">Products</a>
                    <a href="#clients">Orders</a>
                    <a href="#contact">Store Settings</a>
                </div>
            </div>
            <div class="column">
                <table>
                    <tr>
                        <td>Name</td>
                        <td>:<?php echo $name;?></td>
                    </tr>
                    <tr>
                        <td>Shop Name</td>
                        <td>:<?php echo $shopName;?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:<?php echo $address;?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:<?php echo $phone;?></td>
                    </tr>
                    <tr>
                        <td>Region</td>
                        <td>:<?php echo $region;?></td>
                    </tr>
                </table>
            </div>
            <div class="column">
                <fieldset>
                    <legend>
                        <h3>Profile Picture</h3>
                    </legend>
                    <img src="<?php echo $imagePath;?>" alt="Avatar Icon" height="200" width="200" style="align-content: center"><br>
                    <input type="file" name="profilePictureUpload" id="profilePictureUpload">
                    <hr>
                    <h4><?php echo $message ?></h4>
                    <input type="submit" value="Upload Profile Picture" name="submit">
                </fieldset>
            </div>
        </div>

    </form>
<?php include 'footer.php';?>
</body>

</html>