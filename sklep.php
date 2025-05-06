<?php
include_once 'startup.php';
displayhead($status);
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false): ?>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 index-background">
                <h1 class="mt-5">Musisz się zalogować by mieć dostęp do sklepu!</h1>
                <div class="d-flex justify-content-center mt-3">
                    <a class="btn btn-outline-light w-auto center me-2" href="logowanie.php">Logowanie</a>
                    <a class="btn btn-outline-light w-auto center me-2" href="rejestracja.php">Rejestracja</a>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 index-background">
                <h1 class="mt-5">Sklep</h1>
                <?php
                $sql = "SELECT id, title, artist, price, ref_name FROM products";
                $pola = ["id", "title", "artist", "price", "ref_name"];
                $sciezka_folderu = "assets/img/sklep/";
                $rozszerzenie = ".jpg";
                $products = $db->selectCatalog($sql, $pola, $sciezka_folderu, $rozszerzenie);
                echo $products;
                ?>
            </div>
            <div class="row gx-4 gx-lg-5 index-background">
                <h1 class="mt-5">Koszyk</h1>
                <div class="cart">
                    <div id="cart-items"></div>
                    <p id="cart-total">Całkowita wartość: 0.00 zł</p>
                    <button class="btn btn-outline-light" onclick="clearCart()">Wyczyść koszyk</button>
                    <button class="btn btn-outline-light" onclick="purchaseCart()">Kup</button>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- JS Bootstrap'a-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Reszta plików JS-->
<script src="js/scripts.js"></script>
</body>

</html>