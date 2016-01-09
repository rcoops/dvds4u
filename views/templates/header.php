<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $view->pageTitle ?></title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/3.0.2/normalize.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- http://v4-alpha.getbootstrap.com/examples/signin/ -->
    <link rel="stylesheet" href="/css/signin.css">
    <!-- http://v4-alpha.getbootstrap.com/examples/sticky-footer/ -->
    <link rel="stylesheet" href="/css/sticky-footer.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
    <div class="row titlebar">
        <figure>
            <img src="/images/logo.png" height="100px"/>
        </figure>
    </div>
    <div class="row">
        <nav class="navbar col-sm-3">
            <ul class="nav">
                <li>
                    <a href="index.php">
                        Home
                    </a>
                </li>
                <li>
                    <a href="dvds.php">
                        Show DVDs
                    </a>
                </li>
                <li>
                    <a href="checkout.php">
                        Checkout
                    </a>
                </li>
            </ul>
        </nav>
        <main class="col-sm-6">