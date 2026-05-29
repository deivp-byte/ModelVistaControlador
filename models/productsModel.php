<?php

require_once "ddbb/DBConexion.php";

class Product {
    protected $name;
    protected $cod;
    protected $short_name;
    protected $pvp;
    protected $categoryid;
    // private $db;

    public function __construct($row) {
        $this->name = $row["nombre"];
        $this->short_name = $row["short_name"];
        $this->cod = $row["cod"];
        $this->pvp = $row["pvp"];
        $this->categoryid=$row["category_id"];
        // $this->db = DBConexion::connection();
    }


    public static function getAllProducts() {
        $db = DBConexion::connection();
        $data = $db->query("SELECT cod, short_name, nombre, pvp, category_id FROM products");
        $products = array();

        while ( $row = $data->fetch_assoc() ) {
            $product = new Product($row);
            $products[] = $product;
        }

        return $products;
    }
    public static function getTotalBalance(){
        $db =DBConexion::connection();
        $sql = "SELECT SUM(pvp) as total FROM products";
        $result= $db->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0 ;
    }
    public static function getMonitorShortName(){
        $monitor=[];
        $db =DBConexion::connection();
        $sql="SELECT * FROM products WHERE short_name LIKE 'Monitor%'";
        $result= $db->query($sql);
        if ($result){
            while ($row = $result->fetch_assoc()) {
            $product = new Product($row);
            $monitor[] = $product;
            }
        }
        return $monitor;
    }
    public function getProductName() {
        return $this->name;
    }
    public function getProductCategory(){
        return $this->categoryid;
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
    public static function save($short_name, $pvp, $nombre, $categoryid) {
        $db = DBConexion::connection();
        
        $sql = "INSERT INTO products (short_name, pvp, nombre, category_id) VALUES (?, ?, ?,?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$short_name, $pvp, $nombre, $categoryid]);
    }
    public static function delete($cod){
        $db = DBConexion::connection();
        $sql="DELETE FROM products WHERE cod= ?";
        $stmt = $db ->prepare($sql);
        return $stmt->execute([$cod]);

    }
    public static function edit($nombre,$short_name,$pvp,$cod, $categoryid){
        $db =DBConexion::connection();
        $sql="UPDATE products SET nombre=?, short_name=?, pvp=? category_id=?";
        $stmt=$db->prepare($sql);
        return $stmt->execute([$nombre,$short_name,$pvp,$cod,$categoryid]);
    }
    public static function findByCategoryName($search){
        $db = DBConexion::connection();
        // Usamos INNER JOIN para buscar en la tabla 'category' por el campo 'name'
        // El operador LIKE con '%' permite coincidencias parciales (ej: 'serv' encontrará 'Servidors')
        $sql = "SELECT p.* FROM products p 
                INNER JOIN category c ON p.category_id = c.id 
                WHERE c.name LIKE ?";
                
        $stmt = $db->prepare($sql);
        $searchTerm= "%" . $search . "%";
        $stmt->execute([$searchTerm]);
        $result = $stmt -> get_result();
        $products = array();
        while ($row = $result->fetch_assoc()) {
        
        $product = new Product($row);
        $products[] = $product;
        }

        return $products;
    }
}