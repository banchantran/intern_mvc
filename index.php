<?php
session_start();
require_once('core/config.php');
require_once('core/session.php');
require_once('db.php');
// require_once 'vendor/autoload.php';


if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'admin';
    $action = 'home';
}
require_once('routes.php');
