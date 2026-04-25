<?php

require_once "ddbb/DBConexion.php";

class Product {
    protected $name;
    protected $cod;
    protected $short_name;

    protected $category;
    protected $pvp;
    // private $db;

    public function __construct($row) {
        $this->name = $row["nombre"];
        $this->short_name = $row["short_name"];
        $this->cod = $row["cod"];
        $this->pvp = $row["pvp"];
        $this ->category = $row["category"];
        // $this->db = DBConexion::connection();
    }

    public static function getAllProducts() {
        $db = DBConexion::connection();
        $data = $db->query("SELECT cod, short_name, nombre, pvp, category FROM products");
        $products = array();

        while ( $row = $data->fetch_assoc() ) {
            $product = new Product($row);
            $products[] = $product;
        }

        return $products;
    }

    public function getProductName() {
        return $this->name;
    }
    public function getProductCategory(){
        return $this->category;
    }
    public function getProductCode() {
        return $this->cod;
    }

    public function getProductShortName() {
        return $this->short_name;
    }

    public function getProductPvp() {
        return $this->pvp;
    }
    public static function find($cod){
        $db=DBConexion::connection();
        $sql="SELECT * FROM products WHERE cod=?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$cod]);

        $result=$stmt->get_result();

        if ($row=$result->fetch_assoc()){
            return  new Product($row);
        }
        return null;
    }
    public static function save($short_name, $pvp, $nombre, $category) {
        $db = DBConexion::connection();
        
        $sql = "INSERT INTO products (short_name, pvp, nombre, category) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$short_name, $pvp, $nombre, $category]);
    }
    public static function delete($cod){
        $db = DBConexion::connection();
        $sql="DELETE FROM products WHERE cod= ?";
        $stmt = $db ->prepare($sql);
        return $stmt->execute([$cod]);

    }
    public static function edit($nombre,$short_name,$pvp,$category,$cod){
        $db =DBConexion::connection();
        $sql="UPDATE products SET nombre=?, short_name=?, pvp=?, category=?";
        $stmt=$db->prepare($sql);
        return $stmt->execute([$nombre,$short_name,$pvp,$category,$cod]);
    }
}