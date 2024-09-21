<?php
require_once 'app/config/config.php';
require_once 'app/classes/User.php';
require_once 'app/classes/Product.php';

$user = new User;
if ($user->is_logged() && $user->is_admin() && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product();
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_size = $_POST['size'];
    $photo = $_FILES['photo'];
    var_dump($photo);
    $photo_name = basename(path: $photo['name']);
    $photo_path = "public/product_images/" . $photo_name;
    $allowed_ext = ['png', 'jpeg', 'jpg', 'gif'];
    $ext = pathinfo($photo_name, PATHINFO_EXTENSION);

    if (in_array($ext, $allowed_ext) && $photo['size'] < 2000000) {
        if (move_uploaded_file($photo['tmp_name'], $photo_path)) {
            $product->create($product_name, $product_price, $product_size, $photo_path);
            header('Location: index.php');
            exit();
        } else {
            echo "Error moving the file.";
        }
    } else {
        echo "Invalid file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'inc/header.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Add New Product</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" required>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" placeholder="Enter product size" required>
        </div>
        <div class="form-group">
            <label for="photo">Product Image</label>
            <input type="file" class="form-control-file" id="photo" name="photo" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
