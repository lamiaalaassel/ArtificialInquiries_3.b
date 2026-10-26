<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$name = trim((string)($data['name'] ?? ''));
$email = trim((string)($data['email'] ?? ''));
$password = (string)($data['password'] ?? '');

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
    http_response_code(400);
    echo json_encode(['message' => 'Nom, e-mail valide et mot de passe de 8 caractères minimum requis.']);
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :hash)');
    $stmt->execute([
        ':name' => $name,
        ':email' => mb_strtolower($email),
        ':hash' => password_hash($password, PASSWORD_DEFAULT),
    ]);
    http_response_code(201);
    echo json_encode(['message' => 'Compte créé avec succès.']);
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        http_response_code(409);
        echo json_encode(['message' => 'Cette adresse e-mail est déjà utilisée.']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Erreur lors de la création du compte.']);
    }
}
