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
    $product_image = $_POST['photo_path'];
    $product->create($product_name, $product_price, $product_size, $product_image);
    var_dump($_FILES);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<!--
<body>
<div class="container mt-5">
    <h2>Add New Product</h2>
    <form action="" method="post" enctype="multipart/form-data" class="dropzone" id="myDropzone">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" required>
        </div>
        <input type="hidden" name="photo_path" id="photoPathInput">
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>-->

<form action="" method="POST">
    <input type="text" name="name" placeholder="Product name">
    <input type="text" name="price" placeholder="Product price">
    <input type="text" name="size" placeholder="Product size">
    <input type="hidden" name="photo_path" id="photoPathInput">
    <div id="dropzone-upload" class="dropzone"></div>
    <input type="submit" value="Add product">

</form>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
    Dropzone.options.dropzoneUpload = {
        url: "upload_photo.php",
        paramName: "photo",
        maxFilesize: 20, // MB
        acceptedFiles: "image/*",
        init: function () {
            this.on("success", function (file, response) {
                // Parse the JSON response
                const jsonResponse = JSON.parse(response);
                // Check if the file was uploaded successfully
                if (jsonResponse.success) {
                    // Set the hidden input's value to the uploaded file's path
                    document.getElementById('photoPathInput').value = jsonResponse.photo_path;
                } else {
                    console.error(jsonResponse.error);
                }
            });
        }
    };
    // TODO: $_FILES IS EMPTY $FILES['photo'] not found;
</script>
</body>
</html>



