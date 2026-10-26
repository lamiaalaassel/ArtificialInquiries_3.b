<?php
declare(strict_types=1);

/*
 * Proxy local Omeka S.
 * La configuration secrète est hors de htdocs : C:/xampp/omeka-config.php
 * Ce proxy exige une session authentifiée.
 */
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Connexion requise.']);
    exit;
}

$configPath = 'C:/xampp/omeka-config.php';
if (!is_file($configPath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Fichier de configuration Omeka introuvable hors du dossier web.']);
    exit;
}

$config = require $configPath;
if (!is_array($config) || empty($config['base_url']) ||
    empty($config['key_identity']) || empty($config['key_credential'])) {
    http_response_code(500);
    echo json_encode(['error' => 'Configuration Omeka incomplète.']);
    exit;
}

$baseUrl = rtrim($config['base_url'], '/');
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$endpoint = $baseUrl . '/items';
if ($id !== null && $id > 0) {
    $endpoint .= '/' . $id;
}

$query = $_GET;
unset($query['id']);
$query['key_identity'] = $config['key_identity'];
$query['key_credential'] = $config['key_credential'];

if ($method === 'GET') {
    $query['per_page'] = $query['per_page'] ?? 100;
    $endpoint .= '?' . http_build_query($query);
} elseif (!in_array($method, ['POST', 'PATCH', 'DELETE'], true)) {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée.']);
    exit;
} else {
    $endpoint .= '?' . http_build_query($query);
}

$body = file_get_contents('php://input');
$options = [
    'http' => [
        'method' => $method,
        'header' => "Accept: application/json\r\nContent-Type: application/json\r\n",
        'ignore_errors' => true,
        'timeout' => 30,
    ],
];
if (in_array($method, ['POST', 'PATCH'], true)) {
    $options['http']['content'] = $body ?: '{}';
}

$context = stream_context_create($options);
$result = @file_get_contents($endpoint, false, $context);

if ($result === false) {
    http_response_code(502);
    echo json_encode(['error' => 'Impossible de contacter l’API Omeka S. Vérifiez son URL et son état.']);
    exit;
}

$status = 200;
if (isset($http_response_header[0]) &&
    preg_match('/\s(\d{3})\s/', $http_response_header[0], $matches)) {
    $status = (int)$matches[1];
}
http_response_code($status);
echo $result;
