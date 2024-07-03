<?php
require_once 'app/config/config.php';

class User
{
    protected $conn;


    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }
    public function create($name,$username,$email,$password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(name,username,email,password) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $username,$email,$hashed_password);
        $result = $stmt->execute();

        if($result){
            $_SESSION['user_id'] = $result->insert_id;
            return true;
        }
        else{
            return false;
        }

    }
    public function login($username, $password) {
        $sql = "SELECT user_id, password FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $rez = $stmt->get_result();
        var_dump($rez);
        if ($rez->num_rows == 1) {
            $user = $rez->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                return true; // Prijavljivanje uspješno
            }
        }
        return false; // Prijavljivanje nije uspjelo
    }

    public function is_logged(){
        if(isset($_SESSION['user_id'])){
            return true;
        }
        return false;
    }



}