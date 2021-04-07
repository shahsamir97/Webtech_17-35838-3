<?php
require $_SERVER['DOCUMENT_ROOT'] . '/model/db_connect.php';

function addProductToDb($userId, $productName, $productDetails, $price,$category,$imgUrl){
    $conn = db_conn();
    $query = "INSERT INTO product (id,sellerId, productName, productDetails, price,category, imgUrl) values (UUID_SHORT(), '$userId','$productName', '$productDetails', '$price','$category', '$imgUrl')";
    try{
        $conn->exec($query);
    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
    $conn = null;
    return true;
}

function retrieveAllProducts($sellerId){
        $conn = db_conn();
        $query = "select * from product where sellerId='$sellerId'";
        try {
            $result = $conn->query($query);
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return $rows;
        } catch (PDOException $e){
            echo $e->getMessage();
            $conn = null;
            return null;
        }

}

function retrieveProductDetails($productId){
    $conn = db_conn();
    $query = "select * from product where id='$productId'";
    try {
        $result = $conn->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $rows[0];
    } catch (PDOException $e){
        echo $e->getMessage();
        $conn = null;
        return null;
    }

}