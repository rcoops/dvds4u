<?php require_once 'app/init.php';
$view->pageTitle = 'DVDs4u - Sign in';

$usersTable = new \dvds4u\UsersTable();
$user = null;
if(isset($_SESSION['user_first_name'])) {
    if(isset($_POST['logout'])) {
        $_POST = [];
        $_SESSION = [];
        require_once 'views/widgets/login.php';
    } else {
        require_once 'views/widgets/loggedin.php';
    }
} else {
    if (!empty($_POST)) {
        $logInEmail = $_POST['email'];
        $logInPass = $_POST['password'];

        if (empty($logInEmail) || empty($logInPass)) {
            $view->error = 'Email or password not entered.';
        } else {
            $user = getUser($logInEmail);
            if ($user == false) { // User not found in db
                $view->error = 'There is no user registered under that email.';
            } else if (user_inactive($user)) {
                $view->error = "You haven't activated your account.";
            } else if ($user->__get('pass') !== $logInPass) { // ***********Change for hashing***************
                $view->error = 'That username/password combination is wrong!';
            } else {
                $_SESSION['user_first_name'] = $user->__get('first_name');
                $_SESSION['user_id'] = $user->__get('id'); // More secure?
                header('Location:index.php');
            }
        }
    }
    require_once 'views/widgets/login.php';
}

function getUser($email)
{
    $usersTable = new \dvds4u\UsersTable();
    return $usersTable->fetchByEmail($email); // returns false if unsuccessful
}

function user_inactive($user)
{
    return $user->__get('active') == 0;
}