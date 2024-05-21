<?php
require_once __DIR__."/../classes/Db.php";
require_once __DIR__."/../classes/Products.php";
$products  = new Products(new Db);
echo json_encode($products->getProductsByIds($_POST['ids']));