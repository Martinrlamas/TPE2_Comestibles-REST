<?php  
require_once "./libs/Router.php";
require_once "./app/controllers/api.ComestiblesController.php";

// Creamos nuevo Router.
    $router = new Router();

// defina la tabla de Routeo.

$router->addRoute('products', 'GET', 'ComestiblesapiController', 'getProducts');
$router->addRoute('products/:ID', 'GET', 'ComestiblesapiController', 'getProduct');
$router->addRoute('products/:ID', 'DELETE', 'ComestiblesapiController', 'DeleteProduct');
$router->addRoute('products', 'POST', 'ComestiblesapiController', 'InsertProduct');

// Url no encontrada
$router->setDefaultRoute('ComestiblesapiController', 'PageError');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
