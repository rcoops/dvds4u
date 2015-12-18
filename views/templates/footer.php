                </main>
                <aside class="col-xs-3">
                    <?php require_once ROOT . '../aside.php'; ?>
                </aside>
            </div>
        </div>
        <footer class="footer">
            <div class="container footer-container">
                <?php if(isset($_SESSION['user_first_name'])): ?>
                    <p>Logged in as: <?= $_SESSION['user_first_name']; ?></p>

                <?php else: ?>
                    <p>Not logged in</p>
                <?php endif; ?>
            </div>
        </footer>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </body>
</html>