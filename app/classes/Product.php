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
    public function create($name,$price,$size,$image){
        $query = "insert into products(name,price,size,image) values(?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss",$name,$price,$size,$image);
        $stmt->execute();

    }

    public function read($product_id){
        $sql = "SELECT * from products where product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $rez = $stmt->get_result();
        return $rez->fetch_assoc(); // jedan redak
    }
    public function update($product_id, $name, $price, $size, $image){
        $query = "UPDATE products SET name = ?, price = ?, size = ?, image = ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $name, $price, $size, $image, $product_id);
        $stmt->execute();
    }

    public function delete($product_id) {
        // Prvo izbrisati povezane stavke iz order_items
        $stmt = $this->conn->prepare("DELETE FROM order_items WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        // Zatim izbrisati proizvod iz products
        $stmt = $this->conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
    }


}