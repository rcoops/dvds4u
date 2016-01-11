<?php require_once 'templates/header.php'; ?>
    <section class="panel panel-default">
        <header class="panel-heading">
            <div class="pull-right">
                    <a href="dvds.php" class="close" aria-hidden="true">&times;</a>
                <h4><?= $view->price; ?></h4>
            </div>
            <h3><?= $view->pageTitle; ?></h3><h4>(<?= $view->year; ?>)</h4>
        </header>
        <article class="panel-body">
            <figure class="big-image">
                <img src="data:image/jpeg;base64,<?= $view->image; ?>" alt="<?= $view->pageTitle; ?>" />
<!--                <img src="images/dvds/--><?php //echo $view->imageName; ?><!--" alt="--><?php //echo $view->pageTitle; ?><!--"-->
<!--                     class="img-thumbnail" />-->
            </figure>
            <ul class="list-group">
                <li class="list-group-item"><strong>Genre(s): </strong><?= $view->genre; ?></li>
                <li class="list-group-item"><strong>Director: </strong><?= $view->director; ?></li>
                <li class="list-group-item"><strong>Cast: </strong>
                    <?= $view->cast; ?>
                </li>
                <li class="list-group-item"><strong>Synopsis: </strong>
                    <?= $view->synopsis; ?>
                </li>
            </ul>
            <form class="pull-right" action="dvds.php" method="post">
                <input name="film_id" type="hidden" value="<?= $view->pK; ?>"/>
                <button name="add" type="submit" class="btn btn-primary" <?= (!$view->rentable) ? ' disabled' : ''; ?>>
                    <?= ($view->rentable) ? 'Add to Basket' : 'Unavailable' ?>
                </button>
            </form>
        </article>
    </section>
<?php require_once 'templates/footer.php';