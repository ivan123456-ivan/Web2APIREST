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

          public function getAll($sort_by, $order)
          {
                    $query = $this->db->prepare("SELECT * FROM products ORDER BY ? ?");
                    $query->execute([$sort_by, $order]);
                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function insert($name, $price, $stock, $category, $shop, $productImage, $productDescription)
          {
                    $query = $this->db->prepare("INSERT INTO products(name, price, stock, id_categories, id_shops, product_image, product_description)VALUES(?,?,?,?,?,?,?)");
                    $query->execute([$name, $price, $stock, $category, $shop, $productImage, $productDescription]);

                    return $this->db->lastInsertId();
          }
          public function update($name, $price, $stock, $category, $shop, $productImage, $productDescription, $id){
                    $query = $this->db->prepare("UPDATE products SET name = ?, price = ?, stock = ?, id_categories = ?, id_shops = ?, product_image = ?, product_description =? WHERE id = ?");
                    $query->execute([$name, $price, $stock, $category, $shop, $productImage, $productDescription, $id]);
                    
                    return $query->fetch(PDO::FETCH_OBJ);
          }
          public function getProductsByOrder(){
                    $query = $this->db->prepare("SELECT * FROM products ORDER BY name ASC");
                    $query->execute();
                    return $query->fetchAll(PDO::FETCH_OBJ);
          }
}
