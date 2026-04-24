<?php
session_start();
require_once "ddbb/DBConexion.php";
require_once "controllers/productsCtrl.php";


// Instanciem el controlador
$controller = new ProductsCtrl();

// Mirem si l'usuari vol fer alguna acció específica (per defecte, llistar)
$action = $_GET['action'] ?? 'list';

switch ($action){
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller ->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;

}