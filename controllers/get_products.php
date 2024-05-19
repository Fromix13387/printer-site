<?php
require_once "classes/Db.php";
require_once "classes/Products.php";
$products  = new Products(new Db);
echo json_encode($products->getProductsByIds($_POST['ids']));