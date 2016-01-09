<section class="panel panel-default">
    <form class="form-signin" action="<?= $view->currentPage; ?>" method="post">
        <header><h2 class="form-signin-heading">Sign in</h2></header>
        <fieldset>
            <label for="email" class="sr-only">Email address</label><!-- Invisible except to screenreaders -->
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        </fieldset>
        <fieldset>
            <label for="password" class="sr-only">Password</label><!-- Invisible except to screenreaders -->
            <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password"
                   required>
        </fieldset>
        <button name="login" type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
        <button name="reset" type="reset" class="btn btn-lg btn-primary btn-block">Clear</button>
    </form>
    <div class="signin-body">
        <p>If you have not already registered, <a href="register.php">register here</a></p>
        <?php if(isset($view->error)): ?>
            <div class="alert alert-danger fade">
                <span class="glyphicon glyphicon-warning-sign"></span>
                <?= $view->error ?>
            </div>
        <?php endif; ?>
    </div>
</section>