<?php

class NoteCreate {
    private $conn;
    private $table = "tbl_notes"; // Menentukan tabel yang digunakan

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($title, $content, $priority, $isImportant) {
        $query = "INSERT INTO " . $this->table . " (note_title, note, priority, is_important) 
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $title, $content, $priority, $isImportant);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>