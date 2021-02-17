<?php
// handle the user's HTTP requests when they want to log in or log out
//it must call the functions of the "loginManager.php"
//once the request has been received to carry out the action.

//call loginManager functions
require_once('loginManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PHP-EmployeeManagement/php-employee-management-v1/src/library/sessionHelper.php');
$emailInput = $_POST["emailInput"];
$passwordInput = $_POST["passwordInput"];

function logIn($email, $password)
{
    session_start();
    //set session variables
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;
    $_SESSION["startTime"] = time();
    $_SESSION["limitTime"] = $_SESSION["startTime"] + 600;
    header('Location: http://localhost/PHP-EmployeeManagement/php-employee-management-v1/src/dashboard.php');
    exit;
}


if (isset($_GET['logout']) && $_GET['logout'] == true) {
    redirectionToLogin('logOut');
} else {
    if (verifyLoginData($emailInput, $passwordInput)) {
        logIn($emailInput, $passwordInput);
    } else {
        redirectionToLogin('verifyNopassed');
    };
};
