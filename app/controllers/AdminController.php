<?php
include_once "config/database.php";
include_once "app\models\AdminModel.php";

class AdminController {

    private $adminModel;
    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->adminModel = new AdminModel($this->db);
    }
    //untuk menampilkan halaman login
        public function index(){
            if(isset($_SESSION["admin_id"])){
                header("Location: index.php?act=dashboard");
                exit;
        }
        include 'app/views/auth/login.php';
    }

  // tampilkan halaman register
    public function viewRegister(){
        include "app/views/auth/register.php";
    }
    //proses register
    public function register(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];

            // cek username sudah ada atau belum
        if ($this->adminModel->cekUsernameAda($username)) {
            $error = "Username sudah digunakan! Buat username lain.";
            include "app/views/auth/register.php";
            return;
        }

        if ($this->adminModel->register($username, $password)) {
            $success = "Registrasi berhasil! Silakan login.";
            include "app/views/auth/login.php";
        } else {
            $error = "Registrasi gagal.";
            include "app/views/auth/register.php";
        }
    }
}

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $admin = $this->adminModel->login($username, $password);

            if ($admin) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['username'] = $admin['username'];
                header('Location: index.php?act=dashboard');
            }else{
                $error = "Username atau password salah!";
                include 'app/views/auth/login.php';
            }
        }
    }
    public function dashboard()
    {
        if(isset($_SESSION['id_admin'])){
            header('Location: index.php');
            exit;
        }
        include 'app/views/dashboard/index.php';
    }
    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }
}   

?>