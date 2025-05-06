<?php
include_once 'startup.php';
displayhead($status);
if ($status != 2): ?>
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 index-background">
                <h1 class="mt-5">Nie masz uprawnień administratora!</h1>
                <div class="d-flex justify-content-center mt-3">
                    <a class="btn btn-outline-light w-auto center me-2" href="logowanie.php">Logowanie</a>
                    <a class="btn btn-outline-light w-auto center me-2" href="rejestracja.php">Rejestracja</a>
                    <a class="btn btn-outline-light w-auto center me-2" href="logowanie.php?akcja=wyloguj">Wyloguj</a>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 index-background">
            <h1 class="mt-5">Tabela wszystkich zamówień</h1>
            <?php
            $sql = "SELECT * FROM orders";
            $pola = ["id", "user_id", "total", "description", "status", "created_at"];
            $orders = $db->selectOrders($sql, $pola);
            echo $orders;
            ?>
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