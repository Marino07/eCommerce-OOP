<?php
require_once 'app/classes/User.php';
require_once 'app/config/config.php';
$user = new User();
$user->logout();
header("Location: index.php");
exit;