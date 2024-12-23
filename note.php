<?php
include('koneksi.php');
include('NoteCreate.php');
include('NoteRead.php');
include('NoteDelete.php');

class Note {
    private $conn;
    private $table = "tbl_notes"; // Mendefinisikan Properti $table

    // Constructor Menerima Objek Koneksi
    public function __construct($db) {
        $this->conn = $db;
    }

    // Mendapatkan Akses ke Operasi CREATE
    public function create($title, $content, $priority, $isImportant) {
        $noteCreate = new NoteCreate($this->conn);
        return $noteCreate->create($title, $content, $priority, $isImportant);
    }

    // Mendapatkan Akses ke Operasi READ
    public function getAllNotes() {
        $noteRead = new NoteRead($this->conn);
        return $noteRead->getAllNotes();
    }

    // Mendapatkan Akses ke Operasi DELETE
    public function delete($id) {
        $noteDelete = new NoteDelete($this->conn);
        return $noteDelete->delete($id);
    }
}
?>