<section class="panel panel-default">
    <header class="panel-heading"><h1>Sign in</h1></header>
    <article class="panel-body">
        <p>If you have not already registered, <a href="register.php">register here</a></p>
        <p><strong>Log in</strong> using your <strong>email address</strong> and password:</p>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control">
            </fieldset>
            <fieldset class="form-group">
                <label for="pass">Password:</label>
                <input type="password" name="password" class="form-control">
            </fieldset>
            <button name="submit" type="submit" class="btn btn-default">Sign in</button>
            <button name="reset" type="reset" class="btn btn-default">Clear</button>
        </form>
        <?php if(isset($view->error)): ?>
        <div class="alert alert-danger">
            <i class="glyphicon glyphicon-warning-sign"></i>
            <?= $view->error ?>
        </div>
        <?php endif; ?>
    </article>
</section>