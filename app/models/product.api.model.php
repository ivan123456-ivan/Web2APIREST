<?php

require_once "./app/models/api.model.php";
class ProductApiModel extends ApiModel
{
          public function __construct()
          {
                    parent::__construct();
          }

          public function get($productId)
          {
                    $query = $this->db->prepare("SELECT * FROM products WHERE id=?");
                    $query->execute([$productId]);

                    return $query->fetch(PDO::FETCH_OBJ);
          }

          public function getPage($limit, $offset)
          {
                    $query = $this->db->prepare("SELECT * FROM products LIMIT $limit OFFSET $offset");
                    $query->execute();

                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function getAllByCategoryAndOrder($sort_by, $order, $category)
          {
                    $query = $this->db->prepare("SELECT * FROM products WHERE id_categories = ? ORDER BY $sort_by $order");
                    $query->execute([$category]);

                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function getAllByCategory($category)
          {
                    $query = $this->db->prepare("SELECT * FROM products WHERE id_categories = ?");
                    $query->execute([$category]);

                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function getAllOrder($sort_by, $order)
          {
                    $query = $this->db->prepare("SELECT * FROM products ORDER BY $sort_by $order");
                    $query->execute();

                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function getAll()
          {
                    $query = $this->db->prepare("SELECT * FROM products");
                    $query->execute();

                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function insert($name, $price, $stock, $category, $shop, $productImage, $productDescription)
          {
                    $query = $this->db->prepare("INSERT INTO products(name, price, stock, id_categories, id_shops, product_image, product_description)VALUES(?,?,?,?,?,?,?)");
                    $query->execute([$name, $price, $stock, $category, $shop, $productImage, $productDescription]);

                    return $this->db->lastInsertId();
          }
          public function update($name, $price, $stock, $category, $shop, $productImage, $productDescription, $id)
          {
                    $query = $this->db->prepare("UPDATE products SET name = ?, price = ?, stock = ?, id_categories = ?, id_shops = ?, product_image = ?, product_description =? WHERE id = ?");
                    $query->execute([$name, $price, $stock, $category, $shop, $productImage, $productDescription, $id]);

                    return $query->fetch(PDO::FETCH_OBJ);
          }
          public function getProductsByOrder()
          {
                    $query = $this->db->prepare("SELECT * FROM products ORDER BY name ASC");
                    $query->execute();
                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function delete($id)
          {
                    $query = $this->db->prepare("DELETE FROM products WHERE id = ?");
                    $query->execute([$id]);

                    $res = $this->get($id);
                    if ($res) {
                              return false;
                    } else {
                              return true;
                    }
          }

          public function getColumns()
          {
                    $query = $this->db->prepare("SHOW COLUMNS FROM products");
                    $query->execute();
                    return $query->fetchAll(PDO::FETCH_OBJ);
          }
}
