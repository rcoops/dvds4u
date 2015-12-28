<section class="panel panel-default">
    <header class="panel-heading">
        <h4>Basket</h4>
    </header>
    <article class="panel-body">
        <?php if(empty($view->film)): ?>
        <p>No items in your basket!</p>
        <?php else: ?>
        <table class="table table-striped">
            <tbody>
                <?php foreach($view->film as $id => $film): ?>
                <tr>
                    <td><p><?= $film['title']; ?></p></td>
                    <td><p><?= $film['price']; ?></p></td>
                    <td>
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="film_id" value="<?= $id; ?>" />
                            <button name="remove" type="submit" class="btn btn-sm btn-primary float-right">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Total:</strong></td>
                    <td class="align-right"><?= $view->total; ?></td>
                </tr>
            </tbody>
        </table>
        <p class="align-right"><a class="btn btn-primary" href="basket.php">Checkout</a></p>
        <?php endif; ?>
    </article>
</section>