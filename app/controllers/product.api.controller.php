<?php
require_once './app/controllers/api.controller.php';
require_once './app/models/product.api.model.php';
require_once './app/models/category.api.model.php';
require_once './app/models/shop.api.model.php';
class ProductApiController extends ApiController
{
          private $model, $categoryModel, $shopModel;

          public function __construct()
          {
                    parent::__construct();
                    $this->model = new ProductApiModel();
                    $this->categoryModel = new CategoryApiModel();
                    $this->shopModel = new ShopApiModel();
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

          public function getAll($params = [])
          {
                    $sort_by = !empty($_GET["sort_by"]) ? $_GET["sort_by"] :"";
                    $order = (!empty($_GET["order"]) && $_GET["order"] == 1) ? "ASC" :"DESC";
                    $products = $this->model->getAll($sort_by, $order);
                    $this->view->response($products, 200);
          }

          private function validation($body){
            foreach ($body as $elemento) {
              if (!isset($elemento) || empty($elemento)) {
                        $this->view->response("No se completaron todos los campos.", 400);
                        return false;
              }
            }
            return true;
          }
          public function post()
          {
                    $body = $this->getData();
                    if($this->validation($body)){
                      $name = $body->name;
                      $price = $body->price;
                      $stock = $body->stock;
                      $product_description = $body->product_description;
                      $id_categories = $body->id_categories;
                      if (!$this->categoryModel->getCategory($id_categories)) {
                        $this->view->response("La categoria con el id= ".$id_categories." no existe",400);
                        die();
                      }
                      $id_shops = $body->id_shops;
                      if (!$this->shopModel->get($id_shops)) { //verifico que exista la id del shop para no romper la FK
                        $this->view->response("El shop con el id= ".$id_shops." no existe",400);
                        die();
                      }
                      $product_image = $body->product_image;
                      $id = $this->model->insert($name, $price, $stock, $id_categories, $id_shops, $product_image, $product_description);
                      $this->view->response("Producto con el id= ".$id." creado correctamente.", 201);
                    }
          }
        
          public function update(){
            $body = $this->getData();
            if($this->validation($body)){
              $name = $body->name;
              $price = $body->price;
              $stock = $body->stock;
              $product_description = $body->product_description;
              $id_categories = $body->id_categories;
              $id_shops = $body->id_shops;
              $product_image = $body->product_image;
              $id = $body->id;
              $this->model->update($name, $price, $stock, $id_categories, $id_shops, $product_image, $product_description, $id);
              $this->view->response("Producto con el id= ".$id." actualizado correctamente.", 200);
            }              
            
          }

          public function getProductsByOrder(){
              $products = $this->model->getProductsByOrder();
              $this->view->response($products, 200);
          }
}
