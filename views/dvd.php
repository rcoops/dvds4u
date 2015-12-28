<?php require_once 'templates/header.php'; ?>
<section class="panel panel-default">
    <header class="panel-heading">
        <div class="float-right">
            <h4><?= $view->price; ?></h4>
        </div>
        <h3><?= $view->pageTitle; ?></h3><h4>(<?= $view->year; ?>)</h4>
    </header>
    <article class="panel-body">
        <figure class="big-image">
            <img src="images/dvds/<?= $view->picture; ?>" />
        </figure>
        <ul class="list-group">
            <li class="list-group-item"><strong>Director: </strong><?= $view->director; ?></li>
            <li class="list-group-item"><strong>Cast: </strong>
                <?php for($i = 0; $i < $view->totalCast; $i++): ?>
                    <?= $view->actors[$i] . ', '; ?>
                <?php endfor; ?>
                <?= $view->actors[$view->totalCast]; ?>
            </li>
            <li class="list-group-item"><strong>Synopsis: </strong>
                <?= $view->synopsis; ?>
            </li>
        </ul>
        <form class="float-right" action="dvds.php" method="post">
            <input name="film_id" type="hidden" value="<?= $view->id; ?>" />
            <button name="add" type="submit" class="btn btn-primary"
                <?php if(!$view->rentable) {echo ' disabled';}?>>Add to basket</button>
        </form>
    </article>
</section>
<?php require_once 'templates/footer.php';
//$view->rentable = ($_SESSION['user_id'] && !$film->__get('client_id'))