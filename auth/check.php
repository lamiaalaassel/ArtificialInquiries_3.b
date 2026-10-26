<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['authenticated' => false, 'message' => 'Utilisateur non connecté.']);
    exit;
}
echo json_encode(['authenticated' => true, 'user' => $_SESSION['user']]);
