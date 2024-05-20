<?php

class Orders
{
    private Db $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllByLogin($login): false|array
    {
        return $this->db->query('SELECT *, orders.count as count_or,products.name as name_p FROM orders JOIN users ON orders.user_id = users.user_id JOIN products ON products.product_id = orders.product_id WHERE users.login = ? ORDER BY orders.created_at DESC ', [$login])->fetchAll();
    }

    public function getOrders(): bool|array
    {
        return $this->db->query("SELECT *, orders.created_at as created_at_or, orders.count as count_or,products.name as name_p, users.name as name_u FROM orders JOIN users ON orders.user_id = users.user_id JOIN products ON products.product_id = orders.product_id ORDER BY orders.created_at DESC")->fetchAll();
    }

    public function reject($order_id): bool
    {
        return $this->db->queryAdd("UPDATE orders SET status = ? WHERE order_id = ?", ['Отменён', $order_id]);
    }
    public function accept($order_id): bool
    {
        return $this->db->queryAdd("UPDATE orders SET status = ? WHERE order_id = ?", ['Принят', $order_id]);
    }

}