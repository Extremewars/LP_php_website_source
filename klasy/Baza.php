<?php
class Baza
{
    private $mysqli; //uchwyt do BD 
    public function __construct($serwer, $user, $pass, $baza)
    {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        /* sprawdz połączenie */
        if ($this->mysqli->connect_errno) {
            printf(
                "Nie udało sie połączenie z serwerem: %s\n",
                $this->mysqli->connect_error
            );
            exit();
        }
        /* zmien kodowanie na utf8 */
        if ($this->mysqli->set_charset("utf8")) {
            //udało sie zmienić kodowanie 
        }
    } //koniec funkcji konstruktora 
    function __destruct()
    {
        $this->mysqli->close();
    }
    public function select($sql, $pola)
    {
        //parametr $sql – łańcuch zapytania select 
        //parametr $pola - tablica z nazwami pol w bazie  
        //Wynik funkcji – kod HTML tabeli z rekordami (String) 
        $tresc = "";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola); //ile pól 
            $ile = $result->num_rows; //ile wierszy 
            // pętla po wyniku zapytania $results 
            $tresc .= "<table><tbody>";
            while ($row = $result->fetch_object()) {
                $tresc .= "<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody>";
            $result->close(); /* zwolnij pamięć */
        }
        return $tresc;
    }
    public function selectCatalog($sql, $pola, $sciezka_folderu = "assets/img/sklep/", $rozszerzenie = ".jpg")
    {
        $tresc = "<div class='container'>";
        $tresc .= "<div class='row flex-nowrap overflow-auto'>";

        if ($result = $this->mysqli->query($sql)) {
            $produkt = 0;
            while ($row = $result->fetch_object()) {
                $sciezka = $sciezka_folderu . htmlspecialchars($row->ref_name) . $rozszerzenie;
                if($produkt % 4 == 0) $tresc .= "</div><div class='row flex-nowrap overflow-auto'>";
                $produkt += 1;  
                $tresc .= "
                    <div class='col-md-3 mb-3'>
                        <div class='card h-100'>
                            <img src='$sciezka' class='card-img-top' alt='" . htmlspecialchars($row->title) . "'>
                            <div class='card-body'>
                                <h5 class='card-title black-text'>" . htmlspecialchars($row->title) . "</h5>
                                <p class='card-text black-text'><strong>Wykonawca: </strong> " . htmlspecialchars($row->artist) . "</p>
                                <p class='card-text black-text'><strong>Cena: </strong>" . number_format($row->price, 2) . " zł</p>
                            </div>
                            <div class='card-footer text-center'>
                                <button class='btn btn-primary add-to-cart' data-id='" . $row->id . "' " . 'onclick="addToCart({ id:'
                    . $row->id . ", name:'" . $row->title . "', price:" . number_format($row->price, 2) . '})"' . ">Dodaj do koszyka</button>
                            </div>
                        </div>
                    </div>
                ";
            }
            $result->close();
        } else {
            $tresc .= "<p>Błąd zapytania SQL.</p>";
        }

        $tresc .= "</div>";
        $tresc .= "</div>";
        return $tresc;
    }
    public function selectOrders($sql, $pola)
    {
        $tresc = "";
        if ($result = $this->mysqli->query($sql)) {

            $tresc .= '<div class="table-responsive">';
            $tresc .= '<table class="table table-dark table-striped table-hover">';
            $tresc .= '<thead><tr>';
            foreach ($pola as $pole) {
                $tresc .= '<th scope="col">' . htmlspecialchars($pole) . '</th>';
            }
            $tresc .= '<th scope="col">Stan zamówienia</th>';
            $tresc .= '</tr></thead>';

            $tresc .= '<tbody>';
            while ($row = $result->fetch_object()) {
                $tresc .= '<tr>';
                $id = -1;
                foreach ($pola as $pole) {
                    $wartosc = htmlspecialchars($row->$pole);
                    $tresc .= '<td>' . $wartosc . '</td>';
                    switch($wartosc){
                        case "pending": $pending = 1; break;
                        case "delivered": $pending = 2; break;
                        case "cancelled": $pending = 3; break;
                        default: break;
                    }
                    if($id == -1){
                        $id = $wartosc;
                    }
                }
                switch($pending){
                    case 1: 
                        $tresc .= '<td><button class="btn btn-outline-light" onclick="changeDeliveryStatus(1,' . $id . ')">Dostarczona</button>';
                        $tresc .= '<button class="btn btn-outline-light" onclick="changeDeliveryStatus(2,' . $id . ')">Odrzucona</button></td>';
                        break;
                    case 2:
                        $tresc .= '<td>Dostarczona</td>';
                        break;
                    case 3:
                        $tresc .= '<td>Anulowana</td>';
                        break;
                    default: break;
                }
                $tresc .= '</tr>';
            }
            $tresc .= '</tbody></table></div>';

            $result->close();
        } else {
            $tresc = '<div class="alert alert-danger" role="alert">Błąd w zapytaniu SQL.</div>';
        }
        return $tresc;
    }

    public function deleteByUserId($userId, $tabela)
    {
        $sql = "DELETE FROM $tabela WHERE userId='$userId'";
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteBySession($sessionId, $tabela)
    {
        $sql = "DELETE FROM $tabela WHERE sessionId='$sessionId'";
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
    public function insert($sql)
    {
        if ($this->mysqli->query($sql))
            return true;
        else
            error_log("Błąd SQL: " . $this->mysqli->error);
            return false;
    }
    public function getMysqli()
    {
        return $this->mysqli;
    }
    public function selectUser($login, $passwd, $tabela)
    {
        //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami 
        //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne 
        $id = -1;
        $sql = "SELECT * FROM $tabela WHERE userName='$login'";
        if ($result = $this->mysqli->query($sql)) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object(); //pobierz rekord z użytkownikiem 
                $hash = $row->passwd; //pobierz zahaszowane hasło użytkownika  
                //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych: 
                if (password_verify($passwd, $hash))
                    $id = $row->id; //jeśli hasła się zgadzają - pobierz id użytkownika 
            }
        }
        return $id;   //id zalogowanego użytkownika(>0) lub -1 
    }
}