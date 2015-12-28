<?php require_once 'views/templates/header.php'; ?>
    <section class="panel panel-default">
        <header class="panel-heading">
            <h2>Register</h2>
        </header>
        <article class="panel-body">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" class="form-control"
                           value="<?= (isset($view->newUser)) ? $view->newUser['firstName'] : ''; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="address">Address (first line)
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="text" name="address" class="form-control"
                           value="<?= (isset($view->newUser)) ? $view->newUser['address'] : ''; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="city">City
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="text" name="city" class="form-control"
                           value="<?= (isset($view->newUser)) ? $view->newUser['city'] : ''; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="postcode">Postcode
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="text" name="postcode" class="form-control"
                           value="<?= (isset($view->newUser)) ? $view->newUser['postcode'] : ''; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="phone_number">Phone Number
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="text" name="phone_number" class="form-control"
                           value="<?= (isset($view->newUser)) ? $view->newUser['phoneNumber'] : ''; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="email">E-mail
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="email" name="email" class="form-control"
                           value="<?= (isset($view->newUser)) ? $view->newUser['email'] : ''; ?>" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="email_confirm">Confirm e-mail
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="email" name="email_confirm" class="form-control">
                </fieldset>
                <fieldset class="form-group">
                    <label for="password">Password
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="password" name="password" class="form-control" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="password_confirm">Confirm password
                        <span class="glyphicon glyphicon-asterisk" style="color:red"></span>:
                    </label>
                    <input type="password" name="password_confirm" class="form-control" />
                </fieldset>
                <button name="submit" type="submit" class="btn btn-primary">Register</button>
                <p class="float-right">
                    <span class="glyphicon glyphicon-asterisk" style="color:red"></span>
                    - Required field
                </p>
            </form>
            <?php if(isset($view->error)): ?>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    <?= $view->error ?>
                </div>
            <?php endif; ?>
        </article>
    </section>
<?php require_once 'views/templates/footer.php';