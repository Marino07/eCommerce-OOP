<?php
require_once 'inc/header.php';
require_once 'app/classes/User.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new User();
    echo "pozivam funkciju";
    $login = $user->login($username, $password);
    if(!$login){
        $_SESSION['message']['type'] = 'danger';
        $_SESSION['message']['text'] = 'netoacan username ili sifra';
        header("Location: login.php");
        exit;
    }
    header("Location:index.php");

}

?>
<?php if($user->is_logged()){
    header("Location:index.php");
} ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="register.php">Registracija</a>
                </div>
            </div>
        </div>
<?php require_once 'inc/footer.php';?>