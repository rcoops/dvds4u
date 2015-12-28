<?php require_once 'views/templates/header.php'; ?>
<?php if(!isset($view->success)): ?>
<table class="table table-striped">
    <thead>
        <tr><td colspan="3"><h3>Basket</h3></tr></td>
    </thead>
    <tbody>
        <?php if(empty($view->basket)): ?>
        <tr><td><p>No items in your basket!</p></td></tr>
        <?php else: ?>
        <?php foreach($view->basket as $id => $film): ?>
        <tr>
            <td>
                <figure>
                    <img src="images/dvds/<?= $film['picture']; ?>" alt="<?= $film['picture']; ?>" width="100" />
                </figure>
            </td>
            <td>
                <h4 class="align-right"><?= $film['title']; ?></h4>
                <p class="align-right"><?= $film['price']; ?></p>
            </td>
            <td>
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="film_id" value="<?= $id; ?>" />
                    <button name="remove" type="submit" class="btn btn-sm btn-primary float-right">Remove</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="2"><h4>Total:</h4></td>
            <td><h3 class="align-right"><?= $view->total; ?></h3></td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<form action="basket.php" method="post">
    <button name="rent" type="submit" class="btn btn-lg btn-primary float-right">Rent DVDs</button>
</form>
<?php else: ?>
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok-circle"></span>
    <?= $view->success; ?>
</div>
<?php endif; ?>
<?php require_once 'views/templates/footer.php';