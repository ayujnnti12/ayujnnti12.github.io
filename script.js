// Fungsi untuk menghapus catatan tanpa memuat ulang halaman
function deleteNote(id) {
    if (confirm("Apakah Anda yakin ingin menghapus catatan ini?")) {
        // Kirim permintaan AJAX untuk menghapus catatan
        const formData = new FormData();
        formData.append('id', id);
        formData.append('action', 'delete');

        fetch('index.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("Catatan berhasil dihapus")) {
                // Hapus baris catatan dari tabel setelah berhasil dihapus
                const noteRow = document.getElementById('note_' + id);
                noteRow.remove();
                alert("Catatan berhasil dihapus!");
            } else {
                alert("Gagal menghapus catatan!");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi kesalahan. Silakan coba lagi.");
        });
    }
}

// Fungsi untuk menangani Form Submit (CREATE NOTE)
document.getElementById('noteForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form submit secara default
    
    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;
    const priority = document.getElementById('priority').value;
    const isImportant = document.getElementById('isImportant').checked ? '1' : '0';
    
    // Validasi Form
    if (title === "" || content === "") {
        alert("Judul dan Konten harus diisi!");
        return;
    }

    const formData = new FormData();
    formData.append('title', title);
    formData.append('content', content);
    formData.append('priority', priority);
    formData.append('isImportant', isImportant);
    formData.append('action', 'create');

    // Kirim data catatan baru menggunakan AJAX
    fetch('index.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("Catatan berhasil ditambahkan")) {
            alert("Catatan berhasil ditambahkan!");
            // Setelah berhasil menambahkan, perbarui daftar catatan
            location.reload(); // Memuat ulang halaman untuk menampilkan catatan terbaru
        } else {
            alert("Gagal menambahkan catatan!");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Terjadi kesalahan. Silakan coba lagi.");
    });
});