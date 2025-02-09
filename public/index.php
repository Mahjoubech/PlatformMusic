<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Routes\Router;
use App\Controllers\AuthController;
use App\Controllers\PlaylistController;

session_start();

$router = new Router();

// Define routes
$router->add('GET', '/login', [AuthController::class, 'login']);
$router->add('POST', '/login', [AuthController::class, 'login']);
$router->add('GET', '/register', [AuthController::class, 'register']);
$router->add('POST', '/register', [AuthController::class, 'register']);
$router->add('GET', '/playlists', [PlaylistController::class, 'list']);
$router->add('GET', '/playlist/create', [PlaylistController::class, 'create']);
$router->add('POST', '/playlist/create', [PlaylistController::class, 'create']);

// Dispatch request
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($method, $uri);
