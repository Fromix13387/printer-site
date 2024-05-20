<?php

class Db
{
    private array $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    public PDO $connection;
    private PDOStatement $stmt;
    private array $data = [
        'host' => 'localhost',
        'port' => '3306',
        'dbname' => 'db_demo',
        'charset' => 'utf8',
        'user' => 'root',
        'pass' => ''
    ];
//    private array $data = [
//        'host' => '10.16.0.1',
//        'port' => '3306',
//        'dbname' => 'db_demo',
//        'charset' => 'utf8',
//        'user' => 'admin',
//        'pass' => 'b2&f0KRctlWn'
//    ];
    public function __construct()  //метод подключения БД
    {
        try {
            $this->connection = new PDO("mysql:host={$this->data['host']};port={$this->data['port']};dbname={$this->data['dbname']};charset={$this->data['charset']}", $this->data['user'],
                $this->data['pass'], $this->options);
        } catch (PDOException $exception) {
            echo 'Ошибка соединения: ' . $exception->getMessage();
        }
    }

    public function query($query, $params = []): PDOStatement
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);
        return $this->stmt;
    }

    public function queryAdd($query, $params = []): bool
    {
        $this->stmt = $this->connection->prepare($query);
        return $this->stmt->execute($params);
    }

    public function getCountries(): bool|array
    {
        return $this->query("SELECT * FROM countries")->fetchAll();
    }

    public function getCategories(): bool|array
    {
        return $this->query('SELECT * FROM categories')->fetchAll();
    }
    public function getRoles(): bool|array
    {
        return $this->query('SELECT * FROM roles')->fetchAll();
    }

}