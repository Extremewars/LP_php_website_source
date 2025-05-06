<?php
include_once('klasy/User.php');
class RegistrationForm {
    protected $user;
    function __construct(){ ?>
        <h3>Formularz rejestracji</h3>
        <p>
        <form action="rejestracja.php" method="post">
            Nazwa użytkownika: <br><input name="userName"><br>
            Imię i nazwisko: <br><input name="fullName"><br>
            Hasło: <br><input type="password" name="passwd"><br>
            Email: <br><input name="email"><br>
            <input class="btn btn-outline-light" type="submit" name="submit" value="Rejestruj">
            <input class="btn btn-outline-light" type="reset" name="reset" value="Anuluj">
        </form>
        </p>
    <?php
    }
    function checkUser(){
        $args = [
            'userName' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'regexp' => '/^[0-9A-Za-ząęłńśćźżó_]{2,25}$/'
                ]
            ],
            'fullName' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'regexp' => '/^[0-9A-Za-ząęłńśćźżó_ ]{2,40}$/'
                ]
            ],
            'passwd' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'regexp' => '/^[0-9A-Za-ząęłńśćźżó_]{2,25}$/'
                ]
            ],
            'email' => [
                'filter' => FILTER_VALIDATE_EMAIL,
            ],
        ];
        $dane = filter_input_array(INPUT_POST, $args);

        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }
        if ($errors === "") {
            $this->user = new User(
                $dane['userName'],
                $dane['fullName'],
                $dane['email'],
                $dane['passwd']
            );
        } else {
            echo "<p>Błędne dane:$errors</p>";
            $this->user = NULL;
        }
        return $this->user;
    }
}
?>