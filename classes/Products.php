<?php

class Products
{
    private Db $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getProducts(): false|array
    {
        return $this->db->query('SELECT *,countries.name as country, products.name as name_p FROM `products` JOIN countries ON countries.id = products.id_country JOIN categories ON categories.category_id = products.id_category WHERE `count` > 0 ORDER BY `created_at`')->fetchAll();
    }

    public function getProduct($id): false|array
    {
        return $this->db->query('SELECT *,countries.name as country, products.name as name_p FROM `products` JOIN countries ON countries.id = products.id_country JOIN categories ON categories.category_id = products.id_category WHERE `count` > 0 and product_id = ? ORDER BY `created_at`', [$id])->fetch();
    }



}