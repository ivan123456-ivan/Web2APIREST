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
    $page = (isset($_GET["page"]) && is_numeric($_GET["page"])) ? (int) $_GET["page"] : -1;
    $limit = (!empty($_GET["limit"])) ? (int) $_GET["limit"] : 5;
    $sort_by = (!empty($_GET["sort_by"])) ? $_GET["sort_by"] : "";
    $order = (!empty($_GET["order"]) && $_GET["order"] == 1) ? "ASC" : "DESC";
    $category = (!empty($_GET["category"]) && isset($_GET["category"])) ? (int)$_GET["category"] : 0;
    $offset = ($page !== -1) ? $page * $limit : -1;

    if ($sort_by == "" && !$category) { // ni ordenar ni filtrar
      if ($offset !== -1) { // verifico que se haya establecido un offset
        if (!is_integer($page) || !is_integer($limit)) {
          $this->view->response("Error en especificaciones de parámetros.", 404);
          die();
        }
        $products = $this->model->getPage($limit, $offset);
        $this->view->response($products, 200);
      } else {
        $products = $this->model->getAll();
        $this->view->response($products, 200);
      }
    } else if ($sort_by !== "" && $category) { // ordenar && filtrar
      if ($order == "ASC" || $order == "DESC") {
        $this->getAllByCategoryAndOrder($sort_by, $order, $category);
      } else {
        $this->view->response("No se puede ordenar correctamente.", 404);
      }
    } else if ($sort_by == "" && $category) { // solo filtrar
      if ($this->categoryModel->getCategory($_GET["category"])) { // si encuentra la categoría en la DB filtra
        $this->getAllByCategory($category);
      } else {
        $this->view->response("No se pudo encontrar una categoría con el ID = " . $_GET["category"] . ".", 404);
      }
    } else if ($sort_by !== "" && !$category) { // solo ordenar
      $this->getAllByOrder($sort_by, $order);
    }
  }

  private function getAllByCategory($category_id)
  {
    $products = $this->model->getAllByCategory($category_id);
    $this->view->response($products, 200);
  }

  private function getAllByCategoryAndOrder($sort_by, $order, $category)
  {
    if ($this->checkColumn($sort_by)) {
      $products = $this->model->getAllByCategoryAndOrder($sort_by, $order, $category);
      $this->view->response($products, 200);
    } else {
      $this->view->response("No se indico la columna correctamente.", 404);
    }
  }

  private function getAllByOrder($sort_by, $order)
  {
    if ($this->checkColumn($sort_by)) {
      $products = $this->model->getAllOrder($sort_by, $order);
      $this->view->response($products, 200);
    } else {
      $this->view->response("No se indico la columna correctamente.", 404);
    }
  }

  private function checkColumn($sort_by)
  {
    $columns = $this->model->getColumns();
    foreach ($columns as $column) {
      if ($sort_by == $column->Field) {
        return true;
      }
    }
    return false;
  }

  private function validation($body)
  {
    foreach ($body as $elemento) {
      if (!isset($elemento) || empty($elemento)) {
        $this->view->response("No se completaron todos los campos.", 400);
        return false;
      }
    }
    return true;
  }

  private function validationFK($id_categories, $id_shops)
  {
    if (!$this->categoryModel->getCategory($id_categories)) {
      $this->view->response("La categoria con el id= " . $id_categories . " no existe", 404);
      die();
    }
    if (!$this->shopModel->get($id_shops)) { //verifico que exista la id del shop para no romper la FK
      $this->view->response("El shop con el id= " . $id_shops . " no existe", 404);
      die();
    }
  }

  public function post()
  {
    $body = $this->getData();
    if ($this->validation($body)) {
      $name = $body->name;
      $price = $body->price;
      $stock = $body->stock;
      $product_description = $body->product_description;
      $id_categories = $body->id_categories;
      $id_shops = $body->id_shops;
      $this->validationFK($id_categories, $id_shops);
      $product_image = $body->product_image;
      $id = $this->model->insert($name, $price, $stock, $id_categories, $id_shops, $product_image, $product_description);
      if ($id) {
        $this->view->response("Producto con el id= " . $id . " creado correctamente.", 201);
      } else {
        $this->view->response("No se pudo crear el producto", 400);
      }
    }
  }

  public function update()
  {
    $body = $this->getData();
    if ($this->validation($body)) {
      $name = $body->name;
      $price = $body->price;
      $stock = $body->stock;
      $product_description = $body->product_description;
      $id_categories = $body->id_categories;
      $id_shops = $body->id_shops;
      $this->validationFK($id_categories, $id_shops);
      $product_image = $body->product_image;
      $id = $body->id;
      $this->model->update($name, $price, $stock, $id_categories, $id_shops, $product_image, $product_description, $id);
      $this->view->response("Producto con el id= " . $id . " actualizado correctamente.", 200);
    }
  }

  public function getProductsByOrder()
  {
    $products = $this->model->getProductsByOrder();
    $this->view->response($products, 200);
  }

  public function delete($params = [])
  {
    if (isset($params[":ID"])) {
      $exist = $this->model->get($params[":ID"]);
      if ($exist) {
        $deleted = $this->model->delete($params[":ID"]);
        if ($deleted) {
          $this->view->response("El producto con el id = " . $params[":ID"] . " se elimino correctamente.", 200);
        } else {
          $this->view->response("No se pudo eliminar el producto", 400);
        }
      } else {
        $this->view->response("El elemento con el id = " . $params[":ID"] . " no existe.", 404);
      }
    } else {
      $this->view->response("No se proporcionó una ID.", 404);
    }
  }
}
