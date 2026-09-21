<?php
    class AdminModel{
        private $conn;
        private $table_name = "admin"; //nama tabel

        public function __construct($db)
        {
            $this->conn = $db;
        }
        //fungsi untuk registrasi
        public function register($username, $password)
        {
        $query = " INSERT INTO " . $this->table_name ." (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);

        //bersihkan data
        $username = htmlspecialchars(strip_tags($username));

        //hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt ->bindParam(":username", $username);
        $stmt ->bindParam(":password", $hashed_password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
        //fungsi login admin

        public function login($username, $password)
        {
            $query = " SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
            $stmt = $this->conn->prepare($query);

            $username = htmlspecialchars(strip_tags($username));
            $stmt->bindParam(":username", $username);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                //verifikasi password hash
                if(password_verify($password, $row["password"])) {
                    return $row;
                }
        }
        return false;
    }
    public function cekUsernameAda($username) {
        $query = "SELECT username FROM ".$this->table_name . " WHERE username = :username LIMIT 1 ";
        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }
    }
?>