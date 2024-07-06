<?php
require_once 'app/config/config.php';
require_once 'app/classes/User.php';
require_once 'app/classes/Product.php';

$user = new User;
$product = new Product();
$product_details = $product->read($_GET['id']);


if ($user->is_logged() && $user->is_admin() && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_GET['id'];
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_size = $_POST['size'];
    $product_image = $_POST['image'];

    // Update proizvoda
    $update_result = $product->update($product_id, $product_name, $product_price, $product_size, $product_image);

    // Provjeri da li je ažuriranje bilo uspješno
    if ($update_result) {
        // Ponovo učitaj detalje proizvoda
        $product_details = $product->read($product_id);
    }
    header("Location:admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Update Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Update Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $product_details['product_id']; ?>">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product_details['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $product_details['price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" value="<?php echo $product_details['size']; ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="text" class="form-control" id="image" name="image" value="<?php echo $product_details['image']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<