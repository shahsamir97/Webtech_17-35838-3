<?php
use Cassandra\Uuid;
require $_SERVER['DOCUMENT_ROOT']."/model/db_connect.php";

function registerUser($email, $password, $name, $shopName,$phone, $region, $dob, $gender){
    $conn = db_conn();
    $query = "INSERT INTO seller (id, email, password, name, shopName, phone, region, dob, gender) values (UUID_SHORT(), '$email', '$password', '$name', '$shopName', '$phone','$region', '$dob', '$gender')";
    try{
         $conn->exec($query);
    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
    $conn = null;
     return true;
}

function loginUser($email, $password){
    $conn = db_conn();
    $query = "SELECT * FROM seller where email='$email' and password='$password'";
    try{
        $result = $conn->query($query);
    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $rows;
}

function checkEmailExists($email){
    $conn = db_conn();
    $query = "select email from seller where email='$email'";
    try {
        $result = $conn->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        if (sizeof($rows) > 0){
            //when email exists
            return true;
        }else{
            //when email doest not exits
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}