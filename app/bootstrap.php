<?php
session_start();


require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

define('APP_DEFAULT_ROUTE', 'home');

$routesConfigFile = __DIR__ . DIRECTORY_SEPARATOR . 'config/routes.yml';
if (!file_exists($routesConfigFile)) {
    throw new RuntimeException("Routes config file not found");
}
$routes = Yaml::parse(file_get_contents($routesConfigFile), Yaml::PARSE_OBJECT);

//var_dump($routes); die;
if (isset($_GET['route'])){

    if (!$route = $_GET['route'] ?: false) {
        $route = APP_DEFAULT_ROUTE;
    }
}
else{
    $route = APP_DEFAULT_ROUTE;
}


if (!isset($_SESSION['user'])){
    $route = 'login';  
}
if (!array_key_exists($route, $routes)) {
    throw new RuntimeException('Route ' . $route . ' is not found in routes configuration file');
}

$controllerClass = $routes[$route]['class'];
$controllerMethod = $routes[$route]['method'] . 'Action';


if (!class_exists($controllerClass) || !method_exists($controllerClass, $controllerMethod)) {
    throw new RuntimeException('Your Controllers is a shit! '.$controllerClass.' '.$controllerMethod);
}

$response = (new $controllerClass)->$controllerMethod();

if (gettype($response) === "string") {
    header("HTTP/1.1 200 OK");
    header('Content-Type: text/html');
    print($response);
    exit();
}

exit();
