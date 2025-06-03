<?php
class DBConnection {
    private $host;
    private $user;
    private $dbname;
    private $pass;
    private $conn;

    public function __construct() {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->dbname = DB_NAME;
        $this->pass = DB_PASS;

        try {
            $sqlStr = "mysql:host=$this->host;dbname=$this->dbname";
            $this->conn = new PDO($sqlStr, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Bật báo lỗi PDO
        } catch (PDOException $e) {
            $this->conn = null;
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage()); // Hiển thị lỗi
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>