<?php

use App\Controllers\{AdminController, TaskController, AuthController};
use App\Core\{Router, ServerRequest, Application};

require_once __DIR__ . '/bootstrap.php';

$router = new Router();

$router->get('', [TaskController::class, 'index']);
$router->post('', [TaskController::class, 'create']);
$router->get('signup', [AuthController::class, 'signup']);
$router->get('login', [AuthController::class, 'index']);
$router->post('login', [AuthController::class, 'login']);
$router->get('logout', [AuthController::class, 'logout']);
$router->get('admin', [AdminController::class, 'index']);
$router->get('task/edit', [AdminController::class, 'editTask']);
$router->post('task/edit', [AdminController::class, 'updateTask']);

$app = new Application($router);
$app->run(ServerRequest::getPath(), ServerRequest::getMethod());