<?php
include('koneksi.php');
include('Note.php');

// Membuat Objek Koneksi dan Objek Note
$db = new Koneksi();
$koneksi = $db->getConnection();
$note = new Note($koneksi);

// Untuk menyimpan data baru (CREATE)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'create') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $priority = $_POST['priority'];
        $isImportant = isset($_POST['isImportant']) ? '1' : '0';

        if ($note->create($title, $content, $priority, $isImportant)) {
            echo "Catatan berhasil ditambahkan!";
        } else {
            echo "Gagal menambahkan catatan!";
        }
    }

    // Untuk menghapus data (DELETE)
    if ($_POST['action'] == 'delete') {
        $id = $_POST['id'];

        // Pastikan terdapat ID 
        if (isset($id) && !empty($id)) {
            if ($note->delete($id)) {
                echo "Catatan berhasil dihapus!";
            } else {
                echo "Gagal menghapus catatan!";
            }
        } else {
            echo "ID catatan tidak ditemukan!";
        }
    }
}

// Ambil semua catatan
$notes = $note->getAllNotes();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note App</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<h1>Aplikasi Note</h1>

<form id="noteForm" method="POST">
    <label for="title">Judul:</label>
    <input type="text" id="title" name="title" required><br><br>

    <label for="content">Konten:</label>
    <textarea id="content" name="content" required></textarea><br><br>

    <label for="priority">Prioritas:</label>
    <select id="priority" name="priority">
        <option value="low">Rendah</option>
        <option value="medium">Sedang</option>
        <option value="high">Tinggi</option>
    </select><br><br>

    <label for="isImportant">Tandai Penting:</label>
    <input type="checkbox" id="isImportant" name="isImportant"><br><br>

    <button type="submit" name="action" value="create">Simpan Catatan</button>
</form>

<h2>Daftar Catatan</h2>
<table id="notesTable">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Konten</th>
            <th>Prioritas</th>
            <th>Penting</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $notes->fetch_assoc()): ?>
        <tr id="note_<?php echo $row['tbl_notes_id']; ?>">
            <td><?php echo $row['note_title']; ?></td>
            <td><?php echo $row['note']; ?></td>
            <td><?php echo $row['priority']; ?></td>
            <td><?php echo $row['is_important'] ? 'Ya' : 'Tidak'; ?></td>
            <td>
                <button class="btn btn-delete" onclick="deleteNote(<?php echo $row['tbl_notes_id']; ?>)">Hapus</button>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script src="script.js"></script> 
</body>
</html>