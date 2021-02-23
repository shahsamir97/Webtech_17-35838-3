<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>
<style type="text/css">
    .error {
        color: red;
    }

    body {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .inputFieldPadding {
        margin: 20px;
    }
</style>

<body>

    <?php

    //When you upload an Image you can also see the preview when all validation successfully completes.
    //The uploaded file will be transfered to Uploads/ folder.
    //when you run and test this app to able to see the preview you must have an upload folder created 
    // in the same directory from where you run the ProfilePicture.php file.

    $message = "";
    $imagePath ="avatar_icon.png";
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

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
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
    </form>
</body>

</html>