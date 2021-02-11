<?php
// handle the user's HTTP requests when they want to log in or log out
//it must call the functions of the "loginManager.php"
//once the request has been received to carry out the action.

//call loginManager functions
require('loginManager.php');

$emailInput = $_POST["emailInput"];
$passwordInput = $_POST["passwordInput"];

if (verifyLoginData($emailInput, $passwordInput)){
    logIn($emailInput, $passwordInput);
} else {
    redirectionToLogin('verifyNopassed');
};

if (isset($_GET['logout']) && $_GET['logout'] == true){
    logOut();
};


?>