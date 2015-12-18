<section class="panel panel-default">
    <header class="panel-heading"><h1>Welcome <?= $_SESSION['user_first_name']; ?></h1></header>
    <article class="panel-body">
        <p>If you have not already registered, <a href="register.php">register here</a></p>
        <p><strong>Log in</strong> using your <strong>email address</strong> and password:</p>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <button name="logout" type="submit" class="btn btn-default">Log out</button>
        </form>
    </article>
</section>