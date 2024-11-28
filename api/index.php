<?php

require __DIR__ . '/vendor/autoload.php';


use App\Controllers\CategoryController;
use App\Controllers\CourseController;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow all domains to access the resources
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Allow certain HTTP methods
header('Access-Control-Allow-Headers: Content-Type'); // Allow the Content-Type header

// Handle preflight requests (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit;
}

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/categories' && $requestMethod === 'GET') {
    $controller = new CategoryController();
    $controller->list();
} elseif (preg_match('/^\/categories\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'GET') {
    $controller = new CategoryController();
    $controller->show($matches[1]);
} elseif ($requestUri === '/courses' && $requestMethod === 'GET') {
    $controller = new CourseController();
    $controller->list($_GET['category'] ?? null);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
}
