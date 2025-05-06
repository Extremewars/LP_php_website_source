<?php
class UserManager
{
    function loginForm()
    {
        ?>
        <h3>Formularz logowania</h3>
        <p>
        <form action="logowanie.php" method="post">
            Login: <br><input type="text" name="login" /><br> 
            Hasło: <br><input type="password" name="passwd"><br> 
            <input class="btn btn-outline-light" type="submit" value="Zaloguj" name="zaloguj" />
            <input class="btn btn-outline-light" type="reset" value="Anuluj" />
        </form>
        </p> <?php
    }
    function login($db)
    {
        // Funkcja sprawdza poprawność logowania
        // Wynik - id użytkownika zalogowanego lub -1
        $args = [
            'login' => FILTER_UNSAFE_RAW,
            'passwd' => FILTER_UNSAFE_RAW
        ];
        // Przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
        $dane = filter_input_array(INPUT_POST, $args);

        // Sprawdź czy użytkownik o loginie istnieje w tabeli users
        // i czy podane hasło jest poprawne
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");

        if ($userId >= 0) { // Poprawne dane
            //rozpocznij sesję zalogowanego użytkownika
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            //usuń wszystkie wpisy historyczne dla użytkownika o $userId
            $db->deleteByUserId($userId, "logged_in_users");

            //ustaw datę w formacie "Y-m-d H:i:s"
            $currentDate = (new DateTime())->format("Y-m-d H:i:s");

            //pobierz id sesji
            $sessionId = session_id();

            //dodaj wpis do tabeli logged_in_users
            $sql = "INSERT INTO logged_in_users VALUES ('";
            $sql .= $sessionId . "', '";
            $sql .= $userId . "', '";
            $sql .= $currentDate . "');";
            $db->insert($sql);
        }
        return $userId;
    }
    function logout($db)
    {
        //pobierz id bieżącej sesji (pamiętaj o session_start())
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $sessionId = session_id();
        
        if (filter_input(INPUT_COOKIE, session_name())) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        //usuń sesję (łącznie z ciasteczkiem sesyjnym)
        session_destroy();
        //usuń wpis z id bieżącej sesji z tabeli logged_in_users
        $db->deleteBySession($sessionId, "logged_in_users");

    }
    function getLoggedInUser($db, $sessionId)
    {
        //wynik $userId - znaleziono wpis z id sesji w tabeli logged_in_users]
        //wynik -1 - nie ma wpisu dla tego id sesji w tabeli logged_in_users  
        $sql = "SELECT userId FROM logged_in_users WHERE sessionId='$sessionId'";
        $userId = $db->select($sql, ["userId"]);
        if($userId !== null) return $userId;
        return -1;
    }
}