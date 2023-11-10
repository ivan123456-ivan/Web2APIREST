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
          {
                    $products = $this->model->getAll();
                    $this->view->response($products, 200);
          }

          public function post()
          {
                    $body = $this->getData();
                    foreach ($body as $elemento) {
                              if (!isset($elemento) || empty($elemento)) {
                                        $this->view->response("No se completaron todos los campos.", 404);
                                        return;
                              }
                    }

                    $name = $body->name;
                    $price = $body->price;
                    $stock = $body->stock;
                    $product_description = $body->product_description;
                    $id_categories = $body->id_categories;
          }
}
