<?php

class Cart
{
    protected $conn;
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }
    public function add_to_cart($product_id,$user_id,$quantity){
        $stmt = $this->conn->prepare("INSERT INTO cart(user_id,product_id,quantity) VALUES (?,?,?)");
        $stmt->bind_param("iii",$user_id,$product_id,$quantity);
        $stmt->execute();

    }
    public function get_items(){
        $stmt = $this->conn->prepare("SELECT p.product_id, p.name, p.price, p.image,c.quantity
                             FROM cart c 
                             INNER JOIN products p ON c.product_id = p.product_id
                             WHERE c.user_id = ?");

        $stmt->bind_param("i",$_SESSION['user_id']);
        $stmt->execute();
        $rez = $stmt->get_result();
        return $rez->fetch_all(MYSQLI_ASSOC);
    }
    public function get_all_price(){
        $stmt = $this->conn->prepare("SELECT p.price, c.quantity
                                  FROM cart c 
                                  INNER JOIN products p ON c.product_id = p.product_id
                                  WHERE c.user_id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);

        $total_price = 0;
        foreach ($items as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        $stmt->close();
        return $total_price;
    }
    public function get_products_with_total_price() {
        $stmt = $this->conn->prepare("SELECT p.product_id,p.image, p.name, p.price, c.quantity, (p.price * c.quantity) as total_price
                                  FROM cart c 
                                  INNER JOIN products p ON c.product_id = p.product_id
                                  WHERE c.user_id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $items;
    }


    public function earse_cart(){
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $user_id = $_SESSION['user_id'];
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    }


}