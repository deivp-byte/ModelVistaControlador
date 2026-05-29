<?php
require_once "ddbb/DBConexion.php";
class Category{
    protected $name;
    protected $id;
        public function __construct($row) {
        $this->name = $row["name"];
        $this->id= $row["id"];
        // $this->db = DBConexion::connection();
    }
    public function getCategoryName() {
        return $this->name;
    }
    public function  getCategoryId(){
        return $this->id;
    }
    public static function getAllCategories(){
        $db = DBConexion::connection();
        $data = $db->query("SELECT id,name FROM category");
        $categories = array();

        while ( $row = $data->fetch_assoc() ) {
            $category = new Category($row);
            $categories[] = $category;
        }

        return $categories;
    }
    public static function save($id, $name) {
        $db = DBConexion::connection();
        
        $sql = "INSERT INTO category (id,name) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id, $name]);
    }
    public static function delete($id){
        $db = DBConexion::connection();
        $sql="DELETE FROM category WHERE id= ?";
        $stmt = $db ->prepare($sql);
        return $stmt->execute([$id]);
    }
    public static function edit($name, $id){
        $db =DBConexion::connection();
        $sql="UPDATE category SET id=?, name=? WHERE id=?";
        $stmt=$db->prepare($sql);
        return $stmt->execute([$id,$name]);
    }
    public static function find($id){
        $db=DBConexion::connection();
        $sql="SELECT * FROM category WHERE id=?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$id]);

        $result=$stmt->get_result();

        if ($row=$result->fetch_assoc()){
            return  new Category($row);
        }
        return null;
    }
    public static function findByName($name){
        $db= DBConexion::connection();
        $sql="SELECT * FROM category WHERE name=?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$name]);
        $result = $stmt-> get_result();
        if ($row=$result->fetch_assoc()){
            return  new Category($row);
        }
        return null;
    }
}

?>