<?php
require_once 'inc/header.php';
require_once 'app/classes/Cart.php';
require_once 'app/classes/Order.php';
$user = new User;
if (!$user->is_logged()) {
    header("Location:login.php");
    exit;
}
$cart = new Cart();
$total_price = $cart->get_all_price();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $order = new Order();
    $delivery_address = $_POST['address'] . "," . $_POST['country'] . "," . $_POST['city'] . "," . $_POST['postal_code'];
    $order->create($delivery_address);
    $_SESSION['message']['type'] = 'success';
    $_SESSION['message']['text'] = 'Uspjesna narudzbina';
    $order->earse_cart();
    header("Location:index.php");
    exit;


}


?>
<form action="" method="post">
    <div class="form-group">
        <label for="address">Adresa:</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>
    <div class="form-group">
        <label for="country">Država:</label>
        <input type="text" class="form-control" id="country" name="country" required>
    </div>
    <div class="form-group">
        <label for="city">Grad:</label>
        <input type="text" class="form-control" id="city" name="city" required>
    </div>
    <div class="form-group">
        <label for="postal_code">Poštanski broj:</label>
        <input type="text" class="form-control" id="postal_code" name="postal_code" required>
    </div>
    <div class="form-group">
        <label>Za platiti:</label>
        <input type="text" class="form-control" id="city" name="platiti" value="<?php echo $total_price; ?>" readonly >
    </div>
    <button type="submit" class="btn btn-primary">Checkout</button>
</form>


<?php require_once 'inc/footer.php';?>

