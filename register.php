<?php
require_once 'app/classes/User.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new User();
    $created_user = $user->create($name,$username,$email,$password);
    if($created_user){
        $_SESSION['message']['type'] = "success";
        $_SESSION['message']['text'] = "Uspjesna registracija";
        header("Location:index.php");
        exit();
    }else{
        $_SESSION['message']['type'] = "danger";
        $_SESSION['message']['text'] = "Neuspjesna registracija";
        header("Location:index.php");

    }


}

?>
<?php include_once 'inc/header.php'?>
<?php if($user->is_logged()){
    header("Location:index.php");
} ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="POST">
                <h2 class="text-center mb-4">Registracija</h2>
                <div class="form-group">
                    <label for="fullname">Ime i Prezime</label>
                    <input type="text" class="form-control" id="fullname" name="name" required>
                </div>
                <div class="form-group">
                    <label for="username">Korisničko ime</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email adresa</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Lozinka</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registriraj se</button>
            </form>
        </div>
    </div>
<?php  include_once 'inc/footer.php';?>

