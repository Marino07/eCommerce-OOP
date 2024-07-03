<?php
require_once 'app/classes/Product.php';
require_once 'inc/header.php';
$product = new Product();
$product = $product->read( $_GET['product_id']);
?>
<div class="container mt-5">
    <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <img src="images/<?php echo $product['image']; ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text">
                            <strong>Cijena:</strong> $<?php echo number_format($product['price'], 2); ?><br>
                            <strong>Veličina:</strong> <?php echo $product['size']; ?><br>
                        </p>
                    </div>
                    <form action="my_cart.php" method="post">
                        <button type="submit" class="btn btn-primary">Add to cart</button>
                    </form>
                </div>
            </div>
    </div>
</div>

<?php require_once 'inc/footer.php'?>
