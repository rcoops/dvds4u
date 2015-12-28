<section class="panel panel-default">
    <header class="panel-heading">
        <h3>Sign in</h3>
    </header>
    <article class="panel-body">
        <p>If you have not already registered, <a href="register.php">register here</a></p>
        <p><strong>Log in</strong> using your <strong>email address</strong> and password:</p>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control">
            </fieldset>
            <fieldset class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control">
            </fieldset>
            <button name="login" type="submit" class="btn btn-primary">Sign in</button>
            <button name="reset" type="reset" class="btn btn-primary">Clear</button>
        </form>
        <?php if(isset($view->error)): ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-warning-sign"></span>
                <?= $view->error ?>
            </div>
        <?php endif; ?>
    </article>
</section>