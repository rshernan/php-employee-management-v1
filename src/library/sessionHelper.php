<?php
//Check the user session is still active
//if not logout calling function of "loginManager.php"
//In the event that the user remains more than 10 minutes in the session , the user will have to be logged out .

session_start ();

if (session_status()==1) {
    redirectionToLogin();
}

if (isset($_SESSION['startTime']) && $_SESSION['limitTime']) {
    $now = time();
    $startTime = $_SESSION['startTime'];
    $limitTime = $_SESSION['limitTime'];
    $timeLeft = ($now > $startTime ? $now : $startTime) - $startTime;
    if ($timeLeft > $_SESSION['limitTime']) {
        // this session has worn out its welcome; kill it and start a brand new one
        redirectionToLogin('Your session time was over');
    }
}
?>