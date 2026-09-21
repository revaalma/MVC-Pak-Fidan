<?php
include_once 'config/database.php';
include_once 'app/models/KategoriModel.php';

class KategoriController
{
    private $db;
    private $KategoriModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->KategoriModel = new KategoriModel ($this->db);
    }
    public function index()
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        $data_kategori = $this->KategoriModel->getAll();
        include 'app/views/kategori/index.php';
    }
    public function tambah()
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        include 'app/views/kategori/tambah.php';
    }
    public function tambahproses()
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        if ($_POST) {
            $nama = $_POST['nama_kategori'];
            $admin_id = $_SESSION['admin_id'];

            if (!empty($nama)) {
                if ($this->KategoriModel->cekKategoriAda($nama)){
                    $_SESSION['error_msg'] = "Gagal: Kategori '<b>$nama</b>' sudah ada!";
                    header("Location: index.php?act=kategori-tambah");
                    exit;
                } else {
                    $this->KategoriModel->create($nama, $admin_id);
                    $_SESSION['success_msg'] = "Berhasil Tambah Kategori";
                    header("Location: index.php?act=kategori");
                    exit;
                }
            }
        }
    }
    public function edit()
    {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit;
    }

    $id = $_GET['id'];

    $kategori = $this->KategoriModel->getById($id);

    include 'app/views/kategori/edit.php';
}
    public function editproses()
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        if ($_POST) {
            $id = $_POST['id'];
            $nama_baru = $_POST['nama_kategori'];

            if (!empty($nama_baru) && !empty($id)) {

            $kategori_lama = $this->KategoriModel->getById($id);
            if ($nama_baru !== $kategori_lama['nama_kategori']) {

                if ($this->KategoriModel->cekKategoriAda($nama_baru)) {
                    $_SESSION['error_msg'] = "Gagal Update: Kategori '<b>$nama_baru</b>' sudah digunakan!";
                    header("Location: index.php?act=kategori-edit&id=" . $id);
                    exit;
                }
            }
            $this->KategoriModel->update($id, $nama_baru);
            $_SESSION['success_msg'] = "Berhasil Edit Kategori";
        }
    }
    header("Location: index.php?act=kategori");
    exit;
    }
    public function hapus() 
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }

        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $this->KategoriModel->delete($id);
            $_SESSION['success_msg'] = "Berhasil Hapus Kategori";
    }
    header("Location: index.php?act=kategori");
    exit;
} 
}//index() berisi list data yang didapat dari model dan diteruskan ke view
?>