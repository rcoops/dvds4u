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
                                <input type="hidden" name="film_id" value="<?= $id; ?>"/>
                                <label for="remove" class="sr-only">Remove</label>
                                <button name="remove" type="submit" class="close" aria-hidden="true" id="remove">
                                    &times;
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Total:</strong></td>
                    <td><?= $view->total; ?></td>
                </tr>
                </tbody>
            </table>
            <a class="btn btn-primary pull-right" href="checkout.php">Checkout</a>
        <?php endif; ?>
    </article>
</section>