<?php require_once 'app/init.php';
$user = null;

if(isset($_POST['login']) && isset($_POST['email'])) {                     // Trying to log in
    $logInEmail = $_POST['email'];
    $logInPass = $_POST['password'];

    if(empty($logInEmail) || empty($logInPass)) {
        $view->error = 'Email or password not entered.';
    } else {
        $user = (new \dvds4u\UsersTable())->fetchByEmail($logInEmail);      // Attempt to look up the user
        if(!$user) {                                                        // User not found in db
            $view->error = 'There is no user registered under that email.';
        } else if(!$user->__get('active')) {                                // Account made but not activated.
            $view->error = "You haven't activated your account yet! Check your email to activate.";
        } else if(!password_verify($logInPass, $user->__get('pass'))) {     // passwords DON'T match
            $view->error = 'That username/password combination is wrong!';
        } else {                                                            // 'Logging in'
            if($user->__get('first_name')) {                                // First name if entered, email otherwise
                $_SESSION['name'] = $user->__get('first_name');
            } else {
                $_SESSION['name'] = $user->__get('email');
            }
            $_SESSION['user_id'] = $user->__get('id');
        }
    }
    unset($_POST['login']);
}
if(isset($_SESSION['user_id'])) {                                           // Logged in
    if(isset($_POST['logout'])) {                                           // Log out only possible if logged in
        session_destroy();
        unset($_POST);
        require_once 'views/widgets/login.php';                             // Session set but logout pressed
    } else {
        require_once 'views/widgets/logged_in.php';                         // Session set, logout not pressed
    }
} else {
    require_once 'views/widgets/login.php';                                 // Session not set
}