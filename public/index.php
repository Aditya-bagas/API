<?php

header('Content-Type: application/json');

$db = new PDO('sqlite:../database/database.sqlite');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

case 'GET':

    $page = isset($_GET['page'])
        ? (int) $_GET['page']
        : 1;

    $limit = isset($_GET['limit'])
        ? (int) $_GET['limit']
        : 10;

    // Validasi
    if ($page < 1) {
        $page = 1;
    }

    if ($limit < 1) {
        $limit = 10;
    }

    // Batasi maksimal data per halaman
    if ($limit > 50) {
        $limit = 50;
    }

    // Hitung offset
    $offset = ($page - 1) * $limit;

    // Hitung total user
    $totalStmt = $db->query("SELECT COUNT(*) FROM users");
    $total = (int) $totalStmt->fetchColumn();

    // Ambil data sesuai halaman
    $stmt = $db->prepare("
        SELECT *
        FROM users
        ORDER BY id
        LIMIT :limit OFFSET :offset
    ");

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Hitung jumlah halaman
    $totalPages = ceil($total / $limit);

    echo json_encode([
        'success' => true,
        'data' => $users,
        'pagination' => [
            'page' => $page,
            'limit' => $limit,
            'total_data' => $total,
            'total_pages' => $totalPages
        ]
    ]);

    break;

    case 'POST':

        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['name'], $input['email'])) {
            http_response_code(400);

            echo json_encode([
                'success' => false,
                'message' => 'Name dan email wajib diisi'
            ]);

            break;
        }

        $stmt = $db->prepare("
            INSERT INTO users (name, email)
            VALUES (:name, :email)
        ");

        $stmt->execute([
            ':name' => $input['name'],
            ':email' => $input['email']
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'User berhasil ditambahkan',
            'id' => $db->lastInsertId()
        ]);

        break;

    default:

        http_response_code(405);

        echo json_encode([
            'success' => false,
            'message' => 'Method tidak didukung'
        ]);
}