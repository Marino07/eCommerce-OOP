<?php
require_once 'app/config/config.php';
class Product
{
    protected $conn;
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }
    public function fetch_all(){
        $sql = 'SELECT * FROM products';
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC); // vise redaka
    }

    public function read($product_id){
        $sql = "SELECT * from products where product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $rez = $stmt->get_result();
        return $rez->fetch_assoc(); // jedan redak
    }

}