<?php

require_once 'config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$request = rtrim($_SERVER['REQUEST_URI'], '/');
$baseUrl = '/roundabout';
$endpoint = str_replace($baseUrl, '', $request);

require_once 'models/ItemModel.php';
require_once 'controller/ItemController.php';
require_once 'models/SellerModel.php';
require_once 'controller/SellerController.php';
require_once 'view/ItemView.php';
require_once 'view/SellerView.php';

$Itemmodel = new ItemModel($conn);
$Itemview = new ItemView();
$Itemcontroller = new ItemController($Itemmodel, $Itemview);

$sellerModel = new SellerModel($conn);
$sellerView = new SellerView();
$sellerController = new SellerController($sellerModel, $sellerView);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($endpoint === '/items') {
        $Itemcontroller->getAllItems();
    } elseif (strpos($endpoint, '/items/') === 0) {
        $Itemcontroller->getItemById();
    }elseif ($endpoint === '/sellers' || strpos($endpoint, '/sellers/') === 0) {
        $sellerController->handleEndpoint($endpoint);
    }

}
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (strpos($endpoint, '/items/') === 0) {
        $Itemcontroller->updateItemById();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($endpoint === '/sellers') {
        $sellerController->createSeller();
    } elseif($endpoint === '/items') {
        $Itemcontroller->createItem();
    }
}

?>
