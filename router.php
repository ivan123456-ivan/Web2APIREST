<?php
require_once 'config.php';
require_once 'libs/router.php';

require_once 'app/controllers/product.api.controller.php';
require_once 'app/controllers/category.api.controller.php';

$router = new Router();

#                                    endpoint      verbo     controller                   método

$router->addRoute('products/:ID', 'GET',    'ProductApiController', 'get');
$router->addRoute('products', 'GET',    'ProductApiController', 'getAll');
$router->addRoute('products', 'POST',    'ProductApiController', 'post');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
