<?php
//functions for the user can log in, save their session data and log out
include ("sessionHelper.php");

function verifyLoginData ($emailInput, $passwordInput) {
    //Get users information
    $usersFile = file_get_contents('C:\xampp\htdocs\PHP-EmployeeManagement\php-employee-management-v1\resources\users.json');
    $usersArray = json_decode($usersFile, true);
    foreach ($usersArray['users'] as $key => $value) {
        // value is an array where the keys are the user data store and the value each value of them
        foreach ($value as $key => $value) {
            if ($key == 'email') {
                if ($value == $emailInput) {
                    $emailValidate = true;
                } else {
                    $emailValidate = false;
                };
            }
            if ($key == 'password') {
                if (password_verify($passwordInput, $value)) {
                    $passwordValidate = true;
                } else {
                    $passwordValidate = false;
                };
            }
        }
    }
    if ($emailValidate && $passwordValidate) {
        return true;
    } else {
        return false; 
    }
}

function logIn ($email, $password) {
    session_start();
    //set session variables
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;
    $_SESSION["startTime"] = time();
    $_SESSION["limitTime"] = 36000;
    header("Refresh: 0; URL='sessionHelper.php'");
    header('Location: C:\xampp\htdocs\PHP-EmployeeManagement\php-employee-management-v1\src\dashboard.php');
    exit;
}

function logOut () {
    session_start();
    session_destroy();
    /* redirectionToLogin ('logOut'); */
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

?>