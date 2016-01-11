<?php require_once 'templates/header.php'; ?>
    <section class="panel panel-default">
        <header class="panel-heading">
            <h3>Filters</h3>
        </header>
        <form id="form" class="filters panel-body " action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <section class="row">
                <fieldset class="col-xs-4">
                    <label for="title">Title:</label>
                    <input class="form-control" type="text" name="title" id="title"
                           value="<?php if(isset($_POST['title'])) {
                               echo $_POST['title'];
                           } ?>" onchange="submitForm()"/>
                </fieldset>
                <fieldset class="col-xs-4">
                    <label for="genre">Genre:</label>
                    <select name="genre" class="form-control" id="genre" onchange="submitForm()">
                        <?php foreach($view->genres as $genre): ?>
                            <option <?php if($view->selected['genre'] === $genre) {
                                echo 'selected ';
                            } ?>
                                value="<?= $genre; ?>"><?= $genre; ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
                <fieldset class="col-xs-4">
                    <label for="director">Director:</label>
                    <select name="director" class="form-control" id="director" onchange="submitForm()">
                        <?php foreach($view->directors as $director): ?>
                            <option <?php if($view->selected['director'] === $director) {
                                echo 'selected ';
                            } ?>
                                value="<?= $director; ?>"><?= $director; ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            </section>
            <section class="row">
                <fieldset class="col-xs-4">
                    <label for="actor">Actor (surname):</label>
                    <input class="form-control" type="text" name="actor" id="actor"
                           value="<?php if(isset($_POST['actor'])) {
                               echo $_POST['actor'];
                           } ?>" onchange="submitForm()"/>
                </fieldset>
                <fieldset class="col-xs-4">
                    <label for="year_from">Released from:</label>
                    <select name="year_from" class="form-control" id="year_from" onchange="submitForm()">
                        <?php foreach($view->years as $year): ?>
                            <option <?php if($view->selected['year_from'] === $year) {
                                echo 'selected ';
                            } ?>
                                value="<?= $year; ?>"><?= $year; ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
                <fieldset class="col-xs-4">
                    <label for="year_to">Released to:</label>
                    <select name="year_to" class="form-control" id="year_to" onchange="submitForm()">
                        <?php foreach($view->years as $year): ?>
                            <option <?php if($view->selected['year_to'] === $year) {
                                echo 'selected ';
                            } ?>
                                value="<?= $year; ?>"><?= $year; ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            </section>
            <section class="row">
                <fieldset class="col-xs-4">
                    <label for="price">Price:</label>
                    <select name="price" class="form-control" id="price" onchange="submitForm()">
                        <?php foreach($view->prices as $price): ?>
                            <option <?php if($view->selected['price'] === $price) {
                                echo 'selected ';
                            } ?>
                                value="<?= $price; ?>"><?= $price; ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            </section>
            <section class="row">
                <input type="submit" class="hidden"/><!-- form resets without this... -->
                <div class="col-xs-12">
                    <button name="clear" type="submit" class="btn btn-primary centre">Clear filters</button>
                </div>
            </section>
        </form>
    </section>
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
<?php foreach($view->films as $film): ?>
    <section class="well well-sm gallery-section">
        <figure class="fig-thumb">
            <a href="<?= $film['url']; ?>">
                <img src="data:image/jpeg;base64,<?= $film['image']; ?>" alt="<?= $film['title']; ?>"
                     class="img-thumbnail" />
<!--                <img src="images/dvds/--><?php //echo $film['imageName']; ?><!--" alt="--><?php //echo $film['title']; ?><!--"-->
<!--                     class="img-thumbnail" />-->
            </a>
            <figcaption><h5><?= $film['title']; ?></h5></figcaption>
        </figure>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" class="add-form">
            <input name="film_id" type="hidden" value="<?= $film['id']; ?>"/>
            <button name="add" type="submit" class="btn btn-primary" <?= (!$film['rentable']) ? ' disabled' : ''; ?>>
                <?= ($film['rentable']) ? 'Add to Basket' : 'Unavailable' ?>
            </button>
        </form>
    </section>
<?php endforeach; ?>
    <script>
        function submitForm() {
            document.getElementById('form').submit();
        }
    </script>
<?php require_once 'templates/footer.php';