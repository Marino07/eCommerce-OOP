<?php
require_once 'inc/header.php';
require_once 'app/classes/Cart.php';
require_once 'app/classes/Order.php';
$orders = new Order();
$cart = new Cart();
$user = new User;
if (!$user->is_logged()) {
    header("Location:login.php");
    exit;
}
$order = $orders->get_order();
?>
<div class="container-m5">
    <h2>My Orders</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Size</th>
            <th>Image</th>
            <th>Delivery Address</th>
            <th>Order Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($order as $o) : ?>
            <tr>
                <td><?php echo $o['order_id']; ?></td>
                <td><?php echo $o['name']; ?></td>
                <td><?php echo $o['quantity']; ?></td>
                <td><?php echo $o['price']; ?></td>
                <td><?php echo $o['size']; ?></td>
                <td><img src="<?php echo $o['image']; ?>" alt="Product Image" style="width: 100px; height: auto;"></td>
                <td>
                    <?php echo $o['address']; ?><br>
                </td>
                <td><?php echo $o['created_at']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <form action="checkout.php" method="POST">
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </form>
</div>


<?php require_once 'inc/footer.php'; ?>


