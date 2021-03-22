<?php
require $_SERVER['DOCUMENT_ROOT'].'/model/authentication.php';

function signIn($email, $password){
    $result = loginUser($email, $password);
    if (sizeof($result) < 1){
        //login unsuccessful
        return null;
    }else{
        //login successful
        return $result[0]['id'];
    }
}