<?php
require $_SERVER['DOCUMENT_ROOT'] . "/model/seller_profile.php";

function applyProfileEdits($userID, $email,  $name, $shopName, $phone, $region, $dob){
    if (editSellerDetails($userID, $email,  $name, $shopName, $phone, $region, $dob)){
        return true;
    }else{
        return false;
    }
}

function getUserInfo($userId){
    return sellerInfo($userId);
}

function doesEmailAlreadyExist($email){
    if (checkEmailExists($email)){
        return true;
    }else{
        return false;
    }
}


function changeUserPassword($userId, $password){
    if (changePassword($userId, $password)){
        return true;
    }else{
        return false;
    }
}

function getOldPassword($userID){
    return retrieveOldPassword($userID);
}