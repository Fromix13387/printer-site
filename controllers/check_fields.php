<?php

function  check_fields($name, $surname, $patronymic, $login, $email, $password, $password_confirm, $type = 'registration'): array|string
{
    $check_password = true;
    if ($type === 'edit' && empty($password)) {
        $check_password = false;
    }


    if (empty($name) || empty($surname) || empty($patronymic) || empty($login) || empty($email) || $check_password && (empty($password) || empty($password_confirm))) {
        return "<p class='error'>Не все поля заполнены!</p>";
    } else if (preg_match('/[а-яё]/iu', $login)) return "<p class='error'>Логин не должен содержать руских букв</p>";
    else if ($check_password && $password_confirm !== $password) {
        return "<p class='error'>Пароли не совпадают</p>";
    } else {
        require_once __DIR__ . '/../classes/Db.php';
        require_once __DIR__ . '/../classes/Users.php';
        $user = new Users(new Db);
        return ['users' => $user];
    }
}
