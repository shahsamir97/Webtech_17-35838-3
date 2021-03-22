<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/db_connect.php';

function editSellerDetails($userID, $email, $name, $shopName, $phone, $region, $dob)
{
    $conn = db_conn();
    $query = "update seller set email='$email', name='$name', shopName='$shopName', phone='$phone', region='$region', dob='$dob' where id='$userID'";
    try {
        $conn->exec($query);
        $conn = null;
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }
}

function getUserID($email)
{
    $conn = db_conn();
    $query = "select id from seller where email='$email'";
    try {
        $result = $conn->query($query);
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $row[0]['id'];
    } catch (PDOException $e){
        echo $e->getMessage();
        $conn = null;
        return null;
    }
}

function sellerInfo($userId){
    $conn = db_conn();
    $query = "select * from seller where id='$userId'";
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

function changePassword($userID,$password){
    $conn = db_conn();
    $query = "update seller set password='$password' where id='$userID'";
    try {
        $conn->exec($query);
        $conn = null;
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }
}

function retrieveOldPassword($userId){
    $conn = db_conn();
    $query = "select password from seller where id='$userId'";
    try {
        $result = $conn->query($query);
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $row[0]['password'];
    } catch (PDOException $e){
        echo $e->getMessage();
        $conn = null;
        return null;
    }
}


