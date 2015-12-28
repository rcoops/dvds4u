        </main>
        <aside class="col-sm-3">
            <?php require_once 'aside.php'; ?>
        </aside>
    </div>
</div>
<footer class="footer">
    <div class="container footer-container">
        <?php if(isset($_SESSION['name'])): ?>
            <p class="align-right">Logged in as: <?= $_SESSION['name']; ?></p>
        <?php else: ?>
            <p class="align-right">Not logged in</p>
        <?php endif; ?>
    </div>
</footer>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>