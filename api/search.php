<?php
//set post data, null if invalid
$searchTerm = $_POST['searchtag'] ?? null;

//define response value
$result = [];

//check if post is valid
if (!$searchTerm) {
    $result['status'] = 'error';
    $result['data'] = 'No action provided!';
    echo json_encode($result);
    exit;
}

require_once "../bootstrap.php";

//create product
$product = new Product();


$productsLikeName = $product->getAllLike('name', $searchTerm);
$productsLikeDescription = $product->getAllLike('description', $searchTerm);

$products = array_unique(array_merge($productsLikeName, $productsLikeDescription), SORT_REGULAR);
$products_count = count($products);

Log::search($_POST['searchtag'], $products_count);
session_start();

if ($products_count > 0) {
    $_SESSION['search_products_result'] = $products;
} else {
    $_SESSION['search_products_result'] = [];
}

header('Location: '. HOME_URL . '/pages/products.php');


