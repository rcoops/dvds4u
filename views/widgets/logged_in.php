<section class="panel panel-default">
    <header class="panel-heading">
        <h2>Welcome</h2>
        <p><?= $_SESSION['name']; ?></p>
    </header>
    <article class="panel-body">
        <div class="list-group">
            <a href="profile.php" class="list-group-item">Edit Profile</a>
            <a href="change_pass.php" class="list-group-item">Change Password</a>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <button name="logout" type="submit" class="list-group-item">Log out</button>
            </form>
        </div>
    </article>
</section>