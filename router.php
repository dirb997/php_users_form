<?php
// Create the router file where we set all the router connections
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$routes = [
    '' => 'controllers/login.php',
    'signup' => 'controllers/signup.php',
    'dashboard' => 'controllers/dashboard.php',
    'logout' => 'controllers/logout.php'
];
function setRouterConnection($uri, $routes): void
{
    if (array_key_exists($uri, $routes))
    {
        include $routes[$uri];
    }
    else{
        http_response_code(404);
        include 'views/404.view.php';
    }
}

setRouterConnection($uri, $routes);