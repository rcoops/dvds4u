<?php require_once 'app/init.php';
$view->pageTitle = 'DVDs4u - Sign in';
$view->email = null;
$view->noPass = null;


$usersTable = new \dvds4u\UsersTable();
$errors = [];
?>

<?php if(!empty($_POST)) {
    $logInEmail = htmlentities($_POST['email']);
    $logInPass = htmlentities($_POST['password']);

    if(empty($logInEmail) || empty($logInPass)) {
        $errors[] = 'Email or password not entered.';
    } else if(!user_exists($logInEmail)) {
        $errors[] = 'There is no user registered under that email.';
    } else if(!user_active($logInEmail)) {
        $errors[] = "You haven't activated your account.";
//    } else if(login($logInEmail, $logInPass)) {
//        $errors[] = 'That username/password combination is wrong!';
    }
    print_r($errors);
} else {
    require_once 'views/login.php';
}

function user_exists($email)
{
    return $this->usersTable->fetchByEmail($email) == true;
}

function user_active($email)
{
    $user = $this->usersTable->fetchByEmail($email);
    return $user->__get('active') === 1;
}

function login($email, $password)
{
    $user = $this->usersTable->fetchByEmail($email);
    if($password == $user->__get('password')) {

    }
}