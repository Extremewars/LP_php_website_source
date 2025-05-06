<?php
ob_start();
include_once 'startup.php';

// Obsługa wylogowania
if (filter_input(INPUT_GET, "akcja") == "wyloguj") {
    $um->logout($db);
    $_SESSION['loggedin'] = false;
    header("Location: logowanie.php");
    exit();
}

// Obsługa logowania
if (filter_input(INPUT_POST, "zaloguj")) {
    $userId = $um->login($db);
    if ($userId > 0) {
        $_SESSION['loggedin'] = true;
        $username = $db->select("SELECT userName FROM users WHERE id = '$userId'", ["userName"]);
        $_SESSION['username'] = trim(strip_tags($username));
        $_SESSION['userId'] = $userId;
        header("Location: zalogowany.php");
        exit();
    } else {
        $loginError = "Błędna nazwa użytkownika lub hasło";
    }
}
?>
<?php displayhead($status); ?>
<section>
    <br>
    <div class="container px-4 px-lg-5 form-background">
        <div class="row gx-4 gx-lg-5">
            <div class="col-lg-6">
                <h1 class="mt-5">Masz konto? Zaloguj się!</h1>
                <div id="formularz">
                    <?php
                    if (isset($loginError)) {
                        echo "<p>$loginError</p>";
                    }
                    $um->loginForm();
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="mt-5">Nie masz konta? Zarejestruj się!</h1>
                <div id="formularz">
                    <a href="rejestracja.php" class="form-button">Rejestracja</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- JS Bootstrap'a-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>
