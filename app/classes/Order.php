<?php

class Order extends Cart
{
    protected $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function create($delivery_address)
    {
        $stmt = $this->conn->prepare("INSERT INTO orders(user_id,address) VALUES (?,?)");
        $stmt->bind_param("is", $_SESSION['user_id'],$delivery_address);
        $stmt->execute();
        $order_id = $this->conn->insert_id;
        $cart_items = $this->get_items();
        $stmt = $this->conn->prepare("INSERT INTO order_items(order_id,product_id,quantity) VALUES (?,?,?)");
        foreach ($cart_items as $item){
            $stmt->bind_param("iis",$order_id,$item['product_id'],$item['quantity']);
            $stmt->execute();
        }

    }

    public function get_order()
    {
        $stmt = $this->conn->prepare(
            "SELECT
                    orders.order_id,
                    orders.address,
                    orders.created_at,
                    order_items.quantity,
                    products.name,
                    products.size,
                    products.price,
                    products.image
                    FROM orders
                    INNER JOIN order_items ON orders.order_id = order_items.order_id
                    INNER JOIN products ON order_items.product_id = products.product_id
                    WHERE user_id = ?
                    ORDER BY orders.created_at DESC"
        );

        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $rez = $stmt->get_result();
        return $rez->fetch_all(MYSQLI_ASSOC);
    }
    public function insert_order($items,$order_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO order_items (order_id, product_id, price) VALUES (?, ?, ?)");
        foreach ($items as $item){
            $stmt->bind_param("iid", $order_id, $item['product_id'], $item['price']);
        $stmt->execute();
    }
}

}