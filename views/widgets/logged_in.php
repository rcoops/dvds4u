<section class="panel panel-default">
    <header class="panel-heading">
        <h2>Welcome</h2>
        <p><?= $_SESSION['name']; ?></p>
    </header>
    <article class="panel-body">
        <ul class="list-group">
            <a href="profile.php" class="list-group-item bluehover">Edit Profile</a>
            <a href="change_pass.php" class="list-group-item bluehover">Change Password</a>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <button name="logout" type="submit" class="list-group-item">Log out</button>
            </form>
        </ul>
    </article>
</section>