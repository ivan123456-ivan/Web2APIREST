<?php
require_once './app/models/category.api.model.php';
require_once './app/controllers/api.controller.php';
class CategoryApiController extends ApiController
{
          private $model;
          public function __construct()
          {
                    parent::__construct();
                    $this->model = new CategoryApiModel();
          }
}
