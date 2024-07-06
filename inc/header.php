<?php require_once 'app/config/config.php';
require_once 'app/classes/User.php';
$user = new User();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="index.php">Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <?php if(!$user->is_logged()) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="login.php">Login</a>
                </li>
            <?php  else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        Cart
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">My Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>

            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container ">
<?php if (isset($_SESSION['message'])) : ?>
    <!-- Obavijest na vrhu stranice -->
    <div class="alert alert-<?php echo $_SESSION['message']['type']; ?> alert-dismissible fade show text-center mt-3" role="alert">
        <?php
        echo $_SESSION['message']['text'];
        unset($_SESSION['message']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
