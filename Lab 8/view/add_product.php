<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../styles/addProduct_style.css">
    <script type="text/javascript" src="../scripts/add_product.js"></script>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: ../view/seller_profile.php');
}
include "header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/controller/product_controller.php";


$productNameErr = $productDetailsErr = $price = $categoryErr = "";
$productName = $productDetails = $priceErr = $category = "";
$imagePath = null;

//Profile picture change
$message = "";
$imagePath = "../img/img_placeholder.png";

$target_dir = "../storage/product_pictures/";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["profilePictureUpload"])) {
        $temp = explode(".", $_FILES["profilePictureUpload"]["name"]);
        $newFilename = $target_dir.random_int(1,PHP_INT_MAX-1) . $_SESSION['userId'] . '.' . end($temp);
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
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    }

    $productName = test_input($_POST["productName"]);
    if (empty($productName)) {
        $productNameErr = "Name is cannot be empty";
    } else {
      $productNameErr = false;
    }

    $productDetails = test_input($_POST['productDetails']);
    if (empty($productDetails)) {
        $productDetailsErr = "cannot be empty";
    } else {
       $productDetailsErr = false;
    }


    if (isset($_POST['category'])) {
        $category = test_input($_POST['category']);
        $categoryErr = false;
    } else {
        $categoryErr = "Select a category";
    }


    $price = test_input($_POST['price']);
    if (empty($price)){
          $priceErr = "Cannot be empty";
    }else{
         $priceErr = false;
    }


    if (!$productNameErr && !$productDetailsErr
        && !$categoryErr) {
       if (addProduct($_SESSION['userId'], $productName, $productDetails, $price, $category, $imagePath)){
           echo "<script>alert('Product successfully added')</script>";
       }else{
           echo "<script>alert('Something went wrong! Couldn\'t add the product. Try Again')</script>";
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

<form method="post" action="<?php echo htmlspecialchars(@$_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="content" id="reg">
        <div class="rounded-form">
            <h2>Add Product</h2>
            <div class="profile-picture rounded-input-field">
                <p>Product Photo</p>
                <img src="<?php echo $imagePath; ?>" alt="Avatar Icon" height="150" width="180"
                     style="align-content: center"><br>
                <input type="file" name="profilePictureUpload" id="profilePictureUpload">
                <p><?php echo $message ?></p>
            </div><br>
            <div>
                <input id="productName" class="rounded-input-field input-field-margin" type="text" name="productName" placeholder="Product Name"
                       value="<?php echo $productName ?>" onblur="verifyName()"><br>
                <span id="productNameErr" class="error"><?php echo $productNameErr ?></span>
            </div>
            <div>
                <textarea id="productDetails" class="rounded-input-field input-field-margin" name="productDetails"
                          rows="4" cols="40"
                          placeholder="Product Details" onblur="verifyDetails()"></textarea><br>
                <span id="productDetailsErr" class="error"><?php echo $productDetailsErr ?></span>
            </div>
            <div>
                <input id="pPrice" class="rounded-input-field input-field-margin" type="number" name="price"
                       placeholder="Price"
                       value="<?php echo $price ?>" onblur="verifyPrice()"><br>
                <span id="pPriceErr" class="error"><?php echo $priceErr ?></span>
            </div>
            <div class="input-field-margin rounded-input-field">
                <p style="color: gray">Category</p>
                <select name="category" id="category" class="drop-down-menu">
                    <?php
                    include '../utils/utilities.php';
                    $categories = getProductCategory();
                    foreach ($categories as $category) {
                        echo "<option value=" . $category . ">$category</option>";
                    }
                    ?>
                </select><br><span class="error"><?php echo $categoryErr ?></span>
            </div>
            <input class="rectangular-button action-button-margin" type="submit" name="submit" value="Add Product">
        </div>
    </div>
</form>
<?php include "footer.php" ?>
</body>
</html>
