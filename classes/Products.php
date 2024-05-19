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
    public function getProductsByIds($ids): false|array
    {
        return $this->db->query("SELECT *,countries.name as country, products.name as name_p FROM `products` JOIN countries ON countries.id = products.id_country JOIN categories ON categories.category_id = products.id_category WHERE `count` > 0 and product_id in ($ids) ORDER BY `created_at`")->fetchAll();
    }
    public function add($name, $price,$id_country, $year, $model, $id_category, $count, $path): bool
    {
        return $this->db->queryAdd("INSERT INTO products (name, price,id_country,year, model, id_category, count,path) VALUES (?,?,?,?,?,?,?,?)", [
            $name, $price,$id_country, $year, $model, $id_category, $count, $path
        ]);
    }
    public function edit($name, $price,$id_country, $year, $model, $id_category, $count, $path, $product_id): bool
    {
        return $this->db->queryAdd("UPDATE products SET name = ?, price = ?,id_country = ?,year = ?, model = ?, id_category = ?, count = ?,path = ? WHERE product_id = ?", [
            $name, $price,$id_country, $year, $model, $id_category, $count, $path, $product_id
        ]);
    }

    public function delete($product_id): bool
    {
        return $this->db->queryAdd("DELETE FROM products WHERE product_id = ?", [$product_id]);
    }



}