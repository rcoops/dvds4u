<?php require_once 'templates/header.php'; ?>
    <section class="panel panel-default">
        <header class="panel-heading">
            <h2><?= $view->pageTitle ?></h2>
        </header>
        <article class="panel-body">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset class="form-group">
                    <label for="nick_name">Nickname:</label>
                    <input type="text" name="nick_name" class="form-control" id="nick_name"
                           value="<?= (isset($view->user['nick_name'])) ? $view->user['nick_name'] : ''; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="address">Address (first line)
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="text" name="address" class="form-control" id="address"
                           value="<?= $view->user['address']; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="city">City
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="text" name="city" class="form-control" id="city"
                           value="<?= $view->user['city']; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="postcode">Postcode
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="text" name="postcode" class="form-control" id="postcode"
                           value="<?= $view->user['postcode']; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="phone_number">Phone Number
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="text" name="phone_number" class="form-control" id="phone_number"
                           value="<?= $view->user['phone_number']; ?>"/>
                </fieldset>
                <button name="submit" type="submit" class="btn btn-primary">Update</button>
                <p class="float-right">
                    <span class="glyphicon glyphicon-asterisk"></span>
                    - Required field
                </p>
            </form>
            <?php if(isset($view->error)): ?>
                <div class="alert alert-danger fade">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    <?= $view->error; ?>
                </div>
            <?php elseif(isset($view->success)): ?>
                <div class="alert alert-success fade">
                    <span class="glyphicon glyphicon-ok-circle"></span>
                    <?= $view->success ?>
                </div>
            <?php endif; ?>
        </article>
    </section>
<?php require_once 'templates/footer.php';