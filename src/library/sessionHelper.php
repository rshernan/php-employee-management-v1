<?php
//Check the user session is still active
//if not logout calling function of "loginManager.php"
//In the event that the user remains more than 10 minutes in the session , the user will have to be logged out .

session_start();

function redirectionToLogin($cause)
{
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
    header('Location: http://localhost/php-employee-management-v1/index.php?logoutMsg=' . $mns . '&logoutType=' . $type . '');
    exit;
}

if (session_status() == 1) {
    redirectionToLogin('logOut');
}

if (isset($_SESSION['startTime']) && $_SESSION['limitTime']) {
    $now = time();
    if ($now > $_SESSION['limitTime']) {
        // this session has worn out its welcome; kill it and start a brand new one
        redirectionToLogin('Your session time was over');
    }
}
