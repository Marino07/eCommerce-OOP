<?php
require_once 'inc/header.php';
require_once 'app/classes/Cart.php';
$user = new User;
if (!$user->is_logged()) {
    header("Location:login.php");
    exit;
}
$cart = new Cart();
$cart_items = $cart->get_items();
?>
<?php $prices_sum = $cart->get_all_price();
$total = $cart->get_products_with_total_price();


;?>

<div class="container-m5">
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Quantity</th>


        </tr>
    </thead>
    <tbody>
    <?php foreach ($total as $item) : ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['total_price']; ?></td>
            <td><img src="<?php echo $item['image'];?>"> </td>
            <td><?php echo $item['quantity']; ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
    <form action="checkout.php" method="POST">
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </form>
</div>





<?php require_once 'inc/footer.php';?>
