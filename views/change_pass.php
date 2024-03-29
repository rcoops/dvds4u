<?php require_once 'templates/header.php'; ?>
<?php if(!isset($view->success)): ?>
    <section class="panel panel-default">
        <header class="panel-heading">
            <h2><?= $view->pageTitle ?></h2>
        </header>
        <article class="panel-body">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <?php if(!isset($view->verified)): ?>
                    <fieldset class="form-group">
                        <label for="password">Please verify password to continue
                            <span class="glyphicon glyphicon-asterisk"></span>:
                        </label>
                        <input type="password" name="password" class="form-control" id="password" autocomplete="off"
                               required/>
                    </fieldset>
                    <button name="submit" type="submit" class="btn btn-primary">Verify</button>
                <?php else: ?>
                    <fieldset class="form-group">
                        <label for="new_pass">New password
                            <span class="glyphicon glyphicon-asterisk"></span>:
                        </label>
                        <input type="password" name="new_pass" class="form-control" id="new_pass" required />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="conf_pass">Confirm password
                            <span class="glyphicon glyphicon-asterisk"></span>:
                        </label>
                        <input type="password" name="conf_pass" class="form-control" id="conf_pass" required />
                    </fieldset>
                    <button name="submit" type="submit" class="btn btn-primary">Update</button>
                <?php endif; ?>
                <p class="pull-right">
                    <span class="glyphicon glyphicon-asterisk"></span> - Required field
                </p>
            </form>
            <?php if(isset($view->errorMessage)): ?>
                <div class="alert alert-danger fade">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    <strong><?= $view->errorMessage ?></strong>
                    <?php if(isset($view->errors)): ?>
                        <ul>
                            <?php foreach($view->errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </article>
    </section>
<?php else: ?>
    <div class="alert alert-success fade">
        <span class="glyphicon glyphicon-ok-circle"></span>
        <?= $view->success ?>
    </div>
<?php endif; ?>
<?php require_once 'templates/footer.php';