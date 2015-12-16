<?php require_once 'templates/header.php'; ?>
    <h1>Log In</h1>
    <p>If you have not already registered, <a href="register.php">register here</a></p>
    <p><strong>Log in</strong> using your <strong>email address</strong> and password:</p>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control">
        </fieldset>
        <fieldset class="form-group">
            <label for="passcode">Password:</label>
            <input type="password" name="passcode" class="form-control">
        </fieldset>
        <button name="submit" type="submit" class="btn btn-default">Log In</button>
        <button name="reset" type="reset" class="btn btn-default">clear</button>
    </form>
<?php require_once 'templates/footer.php';