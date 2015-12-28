<?php require_once 'views/templates/header.php'; ?>
    <section class="panel panel-default">
        <header class="panel-heading">
            <h2><?= $view->pageTitle ?></h2>
        </header>
        <article class="panel-body">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="id" value="<?= $view->user['id']; ?>" />
                <fieldset class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" class="form-control"
                           value="<?= $view->user['first_name']; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="address">Address (first line)
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="text" name="address" class="form-control"
                           value="<?= $view->user['address']; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="city">City
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="text" name="city" class="form-control"
                           value="<?= $view->user['city']; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="postcode">Postcode
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="text" name="postcode" class="form-control"
                           value="<?= $view->user['postcode']; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="phone_number">Phone Number
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="text" name="phone_number" class="form-control"
                           value="<?= $view->user['phone_number']; ?>" />
                </fieldset>
                <button name="submit" type="submit" class="btn btn-primary">Update</button>
                <p class="float-right">
                    <span class="glyphicon glyphicon-asterisk" style="color:red"></span>
                    - Required field
                </p>
            </form>
            <?php if(isset($view->error)): ?>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    <?= $view->error; ?>
                </div>
            <?php elseif(isset($view->success)): ?>
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok-circle"></span>
                    <?= $view->success ?>
                </div>
            <?php endif; ?>
        </article>
    </section>
<?php require_once 'views/templates/footer.php';