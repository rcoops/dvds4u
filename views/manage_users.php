<?php require_once 'templates/header.php'; ?>
    <section class="panel panel-default">
        <header class="panel-heading">
            <h2><?= $view->pageTitle ?></h2>
        </header>
        <table class="table table-striped">
            <thead class="tab">
            <tr>
                <td>Username</td>
                <td>Active</td>
                <td>Admin</td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($view->users as $user): ?>
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <tr>
                        <input type="hidden" name="id" value="<?= $user['id']; ?>"/>
                        <td><?= $user['email']; ?></td>
                        <td>
                            <label for="active" class="sr-only">Active</label>
                            <input type="checkbox" name="active" id="active"
                                   value="1" <?= ($user['active'] == '1') ? 'checked' : ''; ?> />
                        </td>
                        <td>
                            <label for="admin" class="sr-only">Admin</label>
                            <input type="checkbox" name="admin" id="admin"
                                   value="1" <?= ($user['admin'] == '1') ? 'checked' : ''; ?> />
                        </td>
                        <td>
                            <button type="submit" name="update" class="btn btn-sm btn-primary">Update</button>
                        </td>
                        <td>
                            <button type="submit" name="delete" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
            </tbody>
        </table>
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
    </section>
<?php require_once 'templates/footer.php';