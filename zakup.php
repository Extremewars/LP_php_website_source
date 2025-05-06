<?php
session_start();
include_once 'klasy/Baza.php';
$db = new Baza("db", "user", "userpass", "linkin_park_db");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $userId = $_SESSION['userId'];
    if (!isset($_SESSION['userId'])) {
        http_response_code(403);
        echo json_encode(['error' => 'Użytkownik nie jest zalogowany.']);
        exit;
    }

    $cartTotal = $data['total'];
    if (empty($data['total']) || !is_numeric($data['total'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Nieprawidłowa wartość całkowita.']);
        exit;
    }

    $cartSummary = $data['summary'];
    if (empty($cartSummary) || !is_string($cartSummary)) {
        http_response_code(400);
        echo json_encode(['error' => 'Nieprawidłowy opis koszyka.']);
        exit;
    }   

    try {
        // Bezpieczne zapytanie do bazy danych
        $sql = "INSERT INTO orders (id, user_id, total, description, created_at) VALUES (NULL, $userId, $cartTotal, '$cartSummary', NOW())";
        $db->insert($sql);

        http_response_code(200); // OK
        echo json_encode(['success' => true, 'message' => 'Zakup zrealizowany.']);
    } catch (Exception $e) {
        http_response_code(500); // Błąd serwera
        echo json_encode(['error' => 'Nie udało się zapisać zakupu: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405); // Metoda nieobsługiwana
    echo json_encode(['error' => 'Dozwolone są tylko żądania POST.']);
}
?>
