<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="../styles/productView_style.css"/>
</head>
<body>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/controller/product_controller.php";

if (!isset($_GET['productId'])){
    echo "Invalid Url";
    return;
}

$product = getProductDetails($_GET['productId']);
?>
   <div class="flex-container">
       <div class="content">
          <div class="product-img">
               <img src="<?php echo $product['imgUrl']?>">
          </div>
           <div class="product-info">
               <h2><?php echo $product['productName'].""?></h2>
               <h3 class="underlined-word">Details</h3>
               <p><?php  echo $product['ProductDetails'];?></p>
           </div>
       </div>
   </div>
</body>
</html>