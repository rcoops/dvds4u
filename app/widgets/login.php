<?php

$user = null;
$currentPage = $_SERVER['PHP_SELF'];
// trim off trailing any trailing slashes for form submission
$view->currentPage = rtrim($currentPage, '/');
if(isset($_POST['login']) && isset($_POST['email'])) {                      // Trying to log in
    $logInEmail = $_POST['email'];
    $logInPass  = $_POST['password'];
    $user       = (new \dvds4u\UsersTable())->fetchByEmail($logInEmail);    // Attempt to look up the user

    if(!$user) {                                                            // User not found in db
        $view->error = 'There is no user registered under that email.';
    } else if(!$user->__get('active')) {                                    // Account made but not activated.
        $view->error = "You haven't activated your account yet! Check your email to activate.";
    } else if(!password_verify($logInPass, $user->__get('pass'))) {         // passwords DON'T match
        $view->error = 'That username/password combination is wrong!';
    } else {                                                                // 'Logging in'
        if($user->__get('nick_name')) {                                     // Nick-name if entered, email otherwise
            $_SESSION['name'] = $user->__get('nick_name');
        } else {
            $_SESSION['name'] = $user->__get('email');
        }
        $_SESSION['user_id']    = $user->__get('id');
        $_SESSION['admin']      = $user->__get('admin');
        // Refresh page without resetting headers
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $_SERVER['PHP_SELF'] . '">';
    }
    unset($_POST['login']);
}
if(isset($_SESSION['user_id'])) {                                           // Logged in
    if(isset($_POST['logout'])) {                                           // Log out only possible if logged in
        session_destroy();
        unset($_POST);
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';      // Refresh the page to index
    } else {
        require_once 'views/widgets/logged_in.php';                         // Session set, logout not pressed
    }
} else {
    require_once 'views/widgets/login.php';                                 // Session not set
}