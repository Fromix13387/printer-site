<?php
session_start();
require_once "classes/Db.php";
require_once "classes/Products.php";
$products  = new Products(new Db);
$ids_product = explode(",", $_POST['ids']);
$count = explode(',', $_POST['count']);
if (isset($_SESSION['login']) && $_POST['ids'] &&  $_POST['count']) {
    echo $products->saveOrder($ids_product, $count, $_SESSION['login']);
}
else echo 'Error 404';