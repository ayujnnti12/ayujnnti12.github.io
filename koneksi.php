<?php
if (!class_exists('Koneksi')) {
    class Koneksi {
        private $host = '127.0.0.1';
        private $user = 'root';
        private $password = '';
        private $dbname = 'mahasiswa';
        private $conn;

        public function __construct() {
            $this->conn = new mysqli(
                $this->host,
                $this->user,
                $this->password,
                $this->dbname
            );

            if ($this->conn->connect_error) {
                throw new Exception("Koneksi gagal: " . $this->conn->connect_error);
            }
        }

        public function getConnection() {
            return $this->conn;
        }
    }
}
?>