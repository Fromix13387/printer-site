<?php

class Users
{
    private Db $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUsers(): false|array
    {
        return $this->db->query('SELECT * FROM users')->fetchAll();
    }

    public function getUser($id): false|array
    {
        return $this->db->query('SELECT * FROM users WHERE user_id = ?', [$id])->fetch();
    }
    public function getUserByLogin($login): false|array
    {
        return $this->db->query('SELECT * FROM users WHERE login = ?', [$login])->fetch();
    }
    public function registration($name, $surname, $patronymic, $login, $email, $password): bool
    {
        return $this->db->queryAdd("INSERT INTO users (name, surname, patronymic, login, email, password) VALUE (?, ?, ?, ?, ?, ?)", [
            $name, $surname, $patronymic, $login, $email, password_hash($password, PASSWORD_BCRYPT)
        ]);
    }
    public function edit($name, $surname, $patronymic, $login, $email, $password, $old_login): bool
    {
        if (empty($password)) {
            return $this->db->queryAdd('UPDATE users SET name = ?, surname = ?, patronymic = ?, login = ?, email = ? WHERE login = ?', [
                $name, $surname, $patronymic, $login, $email, $old_login ]);
        }
        return $this->db->queryAdd(
            'UPDATE users SET name = ?, surname = ?, patronymic = ?, login = ?, email = ?, password = ? WHERE login = ?', [
            $name, $surname, $patronymic, $login, $email, password_hash($password, PASSWORD_BCRYPT),  $old_login
        ]);
    }
}