<?php
require_once './app/models/api.model.php';
class CategoryApiModel extends ApiModel
{
          public function __construct()
          {
                    parent::__construct();
          }

          public function getAllCategories()
          {
                    $query = $this->db->prepare('SELECT * FROM categories');
                    $query->execute();

                    return $query->fetchAll(PDO::FETCH_OBJ);
          }

          public function getCategory($id)
          {
                    $query = $this->db->prepare('SELECT * FROM categories WHERE id = ?');
                    $query->execute([$id]);

                    return $query->fetch(PDO::FETCH_OBJ);
          }

          public function updateCategory($value, $id)
          {
                    $query = $this->db->prepare('UPDATE categories SET name = ? WHERE id = ?');
                    $query->execute([$value, $id]);
          }

          public function deleteCategory($id)
          {
                    $query = $this->db->prepare('DELETE FROM categories WHERE id = ?');
                    $query->execute([$id]);
                    if ($this->getCategory($id)) {
                              return false;
                    } else {
                              return true;
                    }
          }

          public function insertCategory($value)
          {
                    $query = $this->db->prepare('INSERT INTO categories(name)VALUES(?)');
                    $query->execute([$value]);

                    return $this->db->lastInsertId();
          }
}
