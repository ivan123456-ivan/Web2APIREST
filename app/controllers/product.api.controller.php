<?php
require_once './app/controllers/api.controller.php';
require_once './app/models/product.api.model.php';
class ProductApiController extends ApiController
{
          private $model;

          public function __construct()
          {
                    parent::__construct();
                    $this->model = new ProductApiModel();
          }

          public function get($params = [])
          {
                    if (isset($params[':ID'])) {
                              $product = $this->model->get($params[':ID']);
                              if (!empty($product)) {
                                        $this->view->response($product, 200);
                              } else {
                                        $this->view->response("El producto con el id " . $params[':ID'] . " no existe.", 404);
                              }
                    } else {
                              $this->getAll();
                    }
          }

          public function getAll()
          { //nico

          }

          public function post()
          {
                    $body = $this->getData();

          }
}
