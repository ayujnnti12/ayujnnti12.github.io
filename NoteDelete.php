<?php

class NoteDelete {
    private $conn;
    private $table = "tbl_notes"; // Menentukan tabel yang digunakan

    public function __construct($db) {
        $this->conn = $db;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE tbl_notes_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id); // Bind parameter dengan tipe data integer
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>