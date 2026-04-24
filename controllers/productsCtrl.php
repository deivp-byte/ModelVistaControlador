<?php

// Call model
require_once "models/productsModel.php";

class ProductsCtrl {
    // Acció per defecte: Llistar
    public function index() {
        $products = Product::getAllProducts();
        require_once "views/productsView.php";
    }

    // Acció de crear
    public function create() {
        // Si ens arriben dades per POST, les guardem
        $errors =[];
        $caracters="";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $short_name = trim($_POST['short_name']?? '');
            $short_name = str_replace($caracters,"",$short_name);
            $pvp = $_POST['pvp']?? null;
            $nombre = $_POST['nombre']?? null;
            $category= $_POST['category']?? null;
            // validació per el short name
            if ($short_name == ''){
                $errors['short'] ="short_name és obligatori";
            }
            elseif(strlen($short_name)<3){
                $errors['short']="\nEL a de ser més gran que 3\n";
             
            }
            // validació de pvp
            if($pvp == null || $pvp == " "){
                $errors['Pvp']="s'ha d'omplir el camp";
                

            }elseif(!is_numeric($pvp) || $pvp <0){
                $errors['Pvp'] ="El camp a de ser un num i major a 0";

            }
            // validació de nom
            if($nombre == null || $nombre ==" "){
                $errors['nombre']="El camp no pot ser buit";
            }
            if($category == null || $category ==" "){
                $errors['category']="El camp no pot ser buit";
            }
            if(empty($errors)){
                if (Product::save($short_name, $pvp, $nombre, $category)) {
                // Si es guarda ok, tornem a la llista principal
                header("Location: index.php");
                }
            }

        }
        
        // Si no és POST (és GET), mostrem el formulari de creació
        require_once "views/addProductView.php";
    }

    public function edit() {return true;}
    public function delete() {return true;}
}

