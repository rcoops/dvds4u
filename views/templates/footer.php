        </main>
        <aside class="col-sm-3">
            <?php require_once 'aside.php'; ?>
        </aside>
    </div>
</div>
<footer class="footer">
    <div class="container footer-container">
        <p class="align-right">
        <?php if(isset($_SESSION['name'])): ?>
            Logged in as: <?= $_SESSION['name']; ?>
        <?php else: ?>
            Not logged in
        <?php endif; ?>
        </p>
    </div>
</footer>
<script src="js/bootstrap.min.js"></script>
</body>
</html>