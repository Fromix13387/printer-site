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
        return $this->db->query('SELECT *, users.name as name_u FROM reviews JOIN users ON reviews.id_user = users.user_id JOIN products ON products.product_id = reviews.id_product')->fetchAll();
    }
    public function getReviewsByProduct($id_product): false|array
    {
        return $this->db->query('SELECT * FROM reviews JOIN users ON reviews.id_user = users.user_id WHERE id_product = ?', [$id_product])->fetchAll();
    }

    public function add($value, $id_product, $login): bool
    {
        return $this->db->queryAdd("INSERT INTO reviews (value, id_user, id_product) VALUE (?, (SELECT user_id FROM users WHERE login = ?), ?)", [$value, $login, $id_product]);
    }

    public function delete($review_id): bool
    {
        return $this->db->queryAdd("DELETE FROM reviews WHERE id = ?", [$review_id]);
    }



}