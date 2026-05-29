<?php
// Call model
require_once "models/categoryModel.php";
class CategoryCtrl{
    public function createCategory() {
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = trim($_POST['id'] ?? '');
            $name = trim($_POST['name'] ?? '');
            // per al id
            if($id == ''){
                $errors['id'] = "El Id de la categoria és obligatori";
            }
            else{
                $existingId=Category::find($id);
                if ($existingId !== null){
                    $errors['id'] = "El codi (ID) '{$id}' ja està utilitzat";
                }
            }
            // per al nom
            if($name == '' || $name == ""){
                $errors['name'] = "El nom de la categoria és obligatori.";
            }
            else{
                $existingName = Category::findByName($name);
                if($existingName !==null){
                    $errors['name'] = "El nom de categoria '{$name}' ja està registrat.";
                }
            }
            if(empty($errors)){
                if (Category::save($id,$name)){
                    header("Location: index.php");
                    exit;
                }
                else {
                    $errors['global'] = "Hi ha hagut un error inesperat en guardar a la base de dades.";
                }
            }

        }

        require_once "views/addCategoryView.php";
    }
}
?>