<?php
require_once 'config.php';
require_once 'libs/router.php';

require_once 'app/controllers/category.api.controller.php';

$router = new Router();

#                                    endpoint      verbo     controller                   método



$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);