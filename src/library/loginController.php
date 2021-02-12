<?php
// handle the user's HTTP requests when they want to log in or log out
//it must call the functions of the "loginManager.php"
//once the request has been received to carry out the action.

//call loginManager functions
require('loginManager.php');
$emailInput = $_POST["emailInput"];
$passwordInput = $_POST["passwordInput"];

function logIn ($email, $password) {
    session_start();
    //set session variables
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;
    $_SESSION["startTime"] = time();
    $_SESSION["limitTime"] = $_SESSION["startTime"] + 600;
    header('Location: http://localhost/PHP-EmployeeManagement/php-employee-management-v1/src/dashboard.php');
    exit;
}

function logOut () {
    session_destroy();
    session_abort();
    /*redirectionToLogin ('logOut'); */
}

function redirectionToLogin ($cause) {
    switch ($cause) {
        case 'timeOut':
            $mns = 'Your session time was over';
            $type = 'alert-danger';
            logOut();
            break;
        case 'logOut':
            $mns = 'You log out correctly';
            $type = 'alert-success';
            logOut();
            break;
        case 'verifyNopassed':
            $mns = 'Your email or password were incorrect';
            $type = 'alert-danger';
            break;
        default:
            $mns = 'There was an error, please login again';
            $type = 'alert-danger';
            logOut();
            break;
    }
    header('Location: ../../index.php?logoutMsg='.$mns.'&logoutType='.$type.'');
    exit;
}

if (isset($_GET['logout']) && $_GET['logout'] == true){
    redirectionToLogin ('logOut');
} else {
    if (verifyLoginData($emailInput, $passwordInput)){
        logIn($emailInput, $passwordInput);
    } else {
        redirectionToLogin('verifyNopassed');
    };
};


?>