<?php
session_start();
include_once 'klasy/Baza.php';
$db = new Baza("db", "user", "userpass", "linkin_park_db");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $status = $data['status'];
    if (empty($data['status']) || !is_numeric($data['status'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Nieprawidłowa wartość całkowita.']);
        exit;
    }

    $order_id = $data['id'];
    if (empty($order_id) || !is_numeric($order_id)) {
        http_response_code(400);
        echo json_encode(['error' => 'Nieprawidłowa wartość całkowita.']);
        exit;
    }

    try {
        if($status == 1){
            $sql = "UPDATE orders SET status = 'cancelled' WHERE id = $order_id;";
        }
        if($status == 2){
            $sql = "UPDATE orders SET status = 'cancelled' WHERE id = $order_id;";
        }
        $db->insert($sql);

        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Zakup zrealizowany.']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Nie udało się zapisać zakupu: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Dozwolone są tylko żądania POST.']);
}
?>
