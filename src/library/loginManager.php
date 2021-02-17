<?php
//functions for the user can log in, save their session data and log out
include ("sessionHelper.php");

function verifyLoginData ($emailInput, $passwordInput) {
    //Get users information
    $usersFile = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/PHP-EmployeeManagement/php-employee-management-v1/resources/users.json");
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
