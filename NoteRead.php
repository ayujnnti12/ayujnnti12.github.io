<?php

class NoteRead {
    private $conn;
    private $table = "tbl_notes"; // Menentukan tabel yang digunakan

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllNotes() {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        return $result;
    }
}
?>