<?php
require_once 'config.php';
require_once 'libs/router.php';

require_once 'app/controllers/product.api.controller.php';
require_once 'app/controllers/category.api.controller.php';

$router = new Router();

#                                    endpoint      verbo     controller                   metodo

$router->addRoute('products/:ID', 'GET',    'ProductApiController', 'get');
$router->addRoute('products', 'GET',    'ProductApiController', 'getAll');
$router->addRoute('products', 'POST',    'ProductApiController', 'post');
$router->addRoute('products/:ID', 'PUT',    'ProductApiController', 'update');
$router->addRoute('products/', 'GET',    'ProductApiController', 'getProductsByOrder');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
