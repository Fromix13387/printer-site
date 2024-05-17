<?php

class Reviews
{
    private Db $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getReviews(): false|array
    {
        return $this->db->query('SELECT * FROM reviews JOIN users ON reviews.id_user = users.user_id JOIN products ON products.product_id = reviews.id_product')->fetchAll();
    }
    public function getReviewsByProduct($id_product): false|array
    {
        return $this->db->query('SELECT * FROM reviews JOIN users ON reviews.id_user = users.user_id WHERE id_product = ?', [$id_product])->fetchAll();
    }




}