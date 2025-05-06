<?php
include_once 'startup.php';
include_once 'klasy/RegistrationForm.php';
include_once 'startup.php';
displayHead($status);
?>
<section>
    <br>
    <div class="container px-4 px-lg-5 form-background">
        <div class="row gx-4 gx-lg-5">
            <div class="col-lg-6">
                <h1 class="mt-5">Nie masz konta? Zarejestruj się!</h1>
                <div id="formularz">
                    <?php
                    $rf = new RegistrationForm();
                    if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                        $user = $rf->checkUser();
                        if ($user === NULL)
                            echo "<p>Niepoprawne dane rejestracji.</p>";
                        else {
                            echo "<p>Poprawne dane rejestracji:</p>";
                            $user->show();
                            $user->saveDB($db);
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="mt-5">Masz konto? Zaloguj się!</h1>
                <div id="formularz">
                    <a href="logowanie.php" class="form-button">Logowanie</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- JS Bootstrap'a-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Reszta plików JS-->
<script src="js/scripts.js"></script>
</body>

</html>