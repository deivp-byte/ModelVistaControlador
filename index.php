<?php
session_start();
require_once "ddbb/DBConexion.php";
require_once "controllers/productsCtrl.php";
require_once "controllers/categoryCtrl.php";


// Instanciem el controlador
$controller = new ProductsCtrl();
$categoryController= new CategoryCtrl();

// Mirem si l'usuari vol fer alguna acció específica (per defecte, llistar)
$action = $_GET['action'] ?? 'dashboard';

switch ($action){
    case 'createCategory':
        $categoryController->createCategory();
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller ->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'list':
        $controller ->index();
        break;
    default:
        $controller->dashboard();
        break;

}