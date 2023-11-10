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

          public function getAll()
          {
                    $query = $this->db->prepare("SELECT * FROM products");
                    $query->execute();
                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function insert()
          {
          }
}
