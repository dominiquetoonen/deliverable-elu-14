<?php

/**
 * Actions:
 * create
 * login
 */
$action = isset($_GET['action']) ? $_GET['action'] : null;

$return = [];

if (!$action) {
    $return['status'] = 'error';
    $return['data'] = 'No action provided!';
    echo json_encode($return);
    exit;
}

require_once "../bootstrap.php";

if ($action === 'create') {
    
    // TODO

} elseif ($action === 'update') {

    if (!$_POST) {
        $return['status'] = 'error';
        $return['data'] = 'No POST data found!';
        echo json_encode($return);
        exit;
    }

    // Save post variables in args array
    $args['ean'] = $_POST['ean'];
    $args['name'] = $_POST['name'];
    $args['description'] = $_POST['description'];

    // Create instance of product
    $product = new Product();
    // Get product by ean
    $product->get($args['ean']);
    // Set new name
    $product->setName($args['name']);
    // Set description
    $product->setDescription($args['description']);

    // Set status to succes
    $return['status'] = 'success';
    // Set return data
    $return['data'] = $args;

    // Save new product data
    if (!$product->save()) {
        // Account creation failed
        $return['status'] = 'error';

        foreach ($product->getSqlErrors() as $error) {
            $product->setError('sqlError', 'Er is iets fout gegaag bij de product update.');
        }

        $return['sqlErrors'] = $product->getSqlErrors();
        $return['errors'] = $product->getErrors();
    }

    echo json_encode($return);

}