
<?php
require_once 'app/classes/Product.php';
$products = new Product();
$products = $products->fetch_all();


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}?>
    <?php include_once 'inc/header.php'?>
<div class="container mt-5">
    <div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img height="300px" width="300px" src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text">
                        <strong>Cijena:</strong> $<?php echo number_format($product['price'], 2); ?><br>
                        <strong>Veličina:</strong> <?php echo $product['size']; ?><br>
                    </p>
                    <a href="view_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">View Product</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
    <?php include_once 'inc/footer.php'; ?>

