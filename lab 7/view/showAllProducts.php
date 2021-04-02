<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/showAllProduct_style.css">
</head>
<body>
<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/controller/product_controller.php";

$products = getAllProducts($_SESSION['userId']);
include "../view/header.php";
?>
<div class="head-line">
    <h2>Products</h2>
</div>
<div class="product-list">
    <div class="row" id="product_list">
        <?php foreach ($products as $key => $product): ?>
            <div class="column" id="<?php echo $product['id']; ?>">
                <div class="card" id="<?php echo $product['id']; ?>">
                    <img id="<?php echo $product['id']; ?>" src="<?php echo $product['imgUrl'] ?>" alt="Product Photo" height="200"/>
                    <h4 id="<?php echo $product['id']; ?>"><?php echo $product['productName'] ?></h4>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<footer>
    <?php include "../view/footer.php" ?>
</footer>
<script src="../scripts/showAllProducts.js"></script>
</body>
</html>
