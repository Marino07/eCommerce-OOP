
<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}?>
    <?php include_once 'inc/header.php'?>
    <div style="padding: 20px;">
        <a href="register.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Registriraj se</a>
    </div>
    <?php include_once 'inc/footer.php'; ?>

