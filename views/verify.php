<?php require_once 'templates/header.php'; ?>

    <section class="panel panel-default">
        <header class="panel-heading">
            <h1>Verification</h1>
        </header>
        <article class="panel-body">
            <?php if(isset($view->email)): ?>
                <p>Congratulations <strong><?= $view->email ?></strong>, your account has been activated!</p>
                <p>Please sign in to continue using your account.</p>
                <?php else: ?>
                <p>Waiting for your account to be activated. Press refresh once you have activated.</p>
                <p>If you haven't received an e-mail in 2 minutes click below:</p>
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <button name="resend" type="submit" class="btn btn-primary">Re-send</button>
                </form>
            <?php endif; ?>
        </article>
    </section>
<?php require_once 'templates/footer.php';