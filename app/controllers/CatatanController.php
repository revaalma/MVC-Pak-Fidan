<?php
include_once 'config/database.php';
include_once 'app/models/CatatanModel.php';
include_once 'app/models/KategoriModel.php';

class CatatanController {
    private $db;
    private $catatanModel;
    private $kategoriModel;

    public function __construct() {
        $database =  new Database();
        $this->db = $database->getConnection();
        $this->catatanModel = new CatatanModel($this->db);
        $this->kategoriModel = new KategoriModel($this->db);
    }

    public function index() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        $data_catatan = $this->catatanModel->getAll();
        include 'app/views/catatan/index.php';
    }
    public function tambah() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        $data_kategori = $this->kategoriModel->getAll();
        include 'app/views/catatan/tambah.php';
    }
public function tambahproses() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit;
    }

    if ($_POST) {
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $kategori_id = $_POST['kategori_id'];
        $admin_id = $_SESSION['admin_id'];

        if (!empty($judul)) {
            $this->catatanModel->create($judul, $isi, $kategori_id, $admin_id);
            $_SESSION['success_msg'] = "Berhasil Tambah Catatan";
        }
    }

    header("Location: index.php?act=catatan");
    exit;
}
public function edit() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit;
    }


    $id = $_GET['id'];

    $catatan = $this->catatanModel->getById($id);

    $data_kategori = $this->kategoriModel->getAll(); 

    include 'app/views/catatan/edit.php';
}

    public function editproses() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }

        if ($_POST) {
            $id = $_POST['id'];
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $kategori_id = $_POST['kategori_id'];

            if (!empty($judul) && !empty($id)) {
                $this->catatanModel->update($id, $judul, $isi, $kategori_id);
                $_SESSION['success_msg'] = "Berhasil Edit Catatan";
            }
        }
        header("Location: index.php?act=catatan");
        exit;
    }
    public function hapus() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        if (isset($_GET['id'])) {
            $this->catatanModel->delete($_GET['id']);
            $_SESSION['success_msg'] = "Berhasil Hapus Catatan";
        }
        header("Location: index.php?act=catatan");
        exit;
    }
}
?>