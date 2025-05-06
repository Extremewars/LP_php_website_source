<?php
ob_start();
include_once 'klasy/Baza.php';
include_once 'klasy/UserManager.php';
$db = new Baza("db", "user", "userpass", "linkin_park_db");
$um = new UserManager();
session_start();
$sessionId = session_id();
$userId = strip_tags($um->getLoggedInUser($db, $sessionId));
$sql = "SELECT status FROM users WHERE id = '$userId'";
$status = strip_tags($db->select($sql, ["status"]));
function displayHead($status){
    ?>
    <!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Linkin Park - Fanpage">
    <meta name="author" content="Paweł Olech">
    <title>Linkin Park - Kim są?</title>
    <!-- Ikonka strony-->
    <link rel="icon" type="image/x-icon" href="assets/Linkin_Park_logo_2014.jpg">
    <!-- Załączonone pliki CSS (z Bootstrap'em)-->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
</head>

<body>
    <br>
    <div class="box-cover"></div>
    <!-- Nawigacja (przyciski na górze strony)-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Linkin Park</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="about.php">Historia zespołu</a></li>
                    <li class="nav-item"><a class="nav-link" href="albumy.php">Albumy</a></li>
                    <li class="nav-item"><a class="nav-link" href="galeria.php">Galeria</a></li>
                    <li class="nav-item"><a class="nav-link" href="koncerty.php">Koncerty</a></li>
                    <li class="nav-item"><a class="nav-link" href="newsletter.php">Newsletter</a></li>
                    <li class="nav-item"><a class="nav-link" href="sklep.php">Sklep</a></li>
                    <?php if ($status == 2){ echo '<li class="nav-item"><a class="nav-link" href="zamowienia.php">Zamówienia</a></li>'; } ?>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">Zalogowany jako
                                <?php
                                if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                                    echo 'gość';
                                    echo '</button>';
                                    echo '<ul class="dropdown-menu">';
                                    echo '<li><a class="dropdown-item" href="logowanie.php">Zaloguj się</a></li>';
                                    echo '<li><a class="dropdown-item" href="rejestracja.php">Zarejestruj się</a></li>';
                                } else {
                                    echo $_SESSION['username'];
                                    echo '</button>';
                                    echo '<ul class="dropdown-menu">';
                                    echo '<li><a class="dropdown-item" href="logowanie.php?akcja=wyloguj">Wyloguj się</a></li>';
                                }
                                ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}
?>