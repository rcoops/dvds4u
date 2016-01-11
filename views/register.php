<?php require_once 'templates/header.php'; ?>
    <section class="panel panel-default">
        <header class="panel-heading">
            <h2>Register</h2>
        </header>
        <article class="panel-body">
            <form action="<?= $_SERVER['PHP_SELF']; ?>#anchor" method="post">
                <fieldset class="form-group">
                    <label for="nick_name">Nickname:</label>
                    <input type="text" name="nick_name" class="form-control" id="nick_name"
                           value="<?= (isset($view->newUser)) ? $view->newUser['nick_name'] : ''; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="address">Address (first line)
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="text" name="address" class="form-control" id="address"
                           value="<?= (isset($view->newUser)) ? $view->newUser['address'] : ''; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="city">City
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="text" name="city" class="form-control" id="city"
                           value="<?= (isset($view->newUser)) ? $view->newUser['city'] : ''; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="postcode">Postcode
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="text" name="postcode" class="form-control" id="postcode"
                           value="<?= (isset($view->newUser)) ? $view->newUser['postcode'] : ''; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="phone_number">Phone Number
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="text" name="phone_number" class="form-control" id="phone_number"
                           value="<?= (isset($view->newUser)) ? $view->newUser['phone_number'] : ''; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="email">E-mail
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="email" name="email" class="form-control" id="email"
                           value="<?= (isset($view->newUser)) ? $view->newUser['email'] : ''; ?>"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="email_confirm">Confirm e-mail
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="email" name="email_confirm" class="form-control" id="email_confirm" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="password">Password
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="password" name="password" class="form-control" id="password" />
                </fieldset>
                <fieldset class="form-group">
                    <label for="password_confirm">Confirm password
                        <span class="glyphicon glyphicon-asterisk"></span>:
                    </label>
                    <input type="password" name="password_confirm" class="form-control" id="password_confirm" />
                </fieldset>
                <button name="submit" type="submit" class="btn btn-primary" id="anchor">Register</button>
                <p class="pull-right">
                    <span class="glyphicon glyphicon-asterisk"></span>
                    - Required field
                </p>
            </form>
            <?php if(isset($view->errorMessage)): ?>
                <div class="alert alert-danger fade">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    <strong><?= $view->errorMessage ?></strong>
                    <ul>
                        <?php foreach($view->errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </article>
    </section>
<?php require_once 'templates/footer.php';