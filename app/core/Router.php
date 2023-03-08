<?php
require './app/controllers/Home_Controller.php';
require './app/controllers/User_Controller.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'home']);
    $r->addRoute('GET', '/user', [UserController::class, 'user']);
    $r->addRoute('GET', '/user/logout', [UserController::class, 'logoutUser']);
    $r->addRoute('GET', '/user/authenticator', [UserController::class, 'userAuthenticator']);


    $r->addRoute('POST', '/user/register', [UserController::class, 'registerUser']);
    $r->addRoute('POST', '/user/login', [UserController::class, 'loginUser']);
    $r->addRoute('POST', '/user/authenticate', [UserController::class, 'authenticateUser']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $handlerInstance = new $handler[0]();
        $handlerInstance->{$handler[1]}($vars);
        break;
}
