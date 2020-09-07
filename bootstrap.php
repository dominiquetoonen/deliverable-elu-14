<?php

/**
 * This file is used to include all required files to run the application.
 */

// CONFIG
require_once 'config.php';

// UTILS
require_once "utils/Secure.php";
require_once "utils/Log.php";
require_once "utils/CoreElement.php";
require_once "utils/StringFormat.php";

// DATABASE
require_once 'models/Database.php';
// Set GLOBAL db var
$db = new Database();

// MODELS
require_once "models/Account.php";
require_once "models/Product.php";
require_once "models/CompanyProduct.php";
require_once "models/ProductAttribute.php";
require_once "models/ProductCategory.php";
require_once "models/ProductImage.php";

// CONTROLLERS
require_once 'controllers/LoginController.php';