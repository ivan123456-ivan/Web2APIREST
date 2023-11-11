<?php
require_once './app/models/api.model.php';
class ShopApiModel extends ApiModel {
                public function __construct() {
                                parent::__construct();
                }

                public function get($shop_id) {
                    $query = $this->db->prepare('SELECT * FROM shops WHERE id = ?');
                    $query->execute([$shop_id]);

                    return $query->fetch(PDO::FETCH_OBJ);
                }
          }
?>