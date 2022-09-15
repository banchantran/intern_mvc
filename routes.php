<?php

$controllers = array(
    'admin' => ['home', 'search_admin', 'create', 'delete', 'edit', 'search_user', 'delete_user'],
    'user' => ['login', 'home', 'logout']
);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';
}


include_once('controllers/' . ucwords($controller) . 'Controller.php');
$class = ucwords($controller) . 'Controller';
$controller = new $class;
$controller->$action();
