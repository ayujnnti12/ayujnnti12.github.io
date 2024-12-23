-- Membuat database dengan nama "mahasiswa"
CREATE DATABASE IF NOT EXISTS mahasiswa;

-- Gunakan database "mahasiswa"
USE mahasiswa;

-- Membuat tabel "users" untuk menyimpan data pengguna
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Membuat tabel "notes" untuk menyimpan data notes 
-- Membuat tabel "notes" dengan PRIMARY KEY dan AUTO_INCREMENT
CREATE TABLE `tbl_notes` (
  `tbl_notes_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_title` text NOT NULL,
  `note` longtext NOT NULL,
  `priority` ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'low',  -- Menambahkan kolom prioritas
  `is_important` TINYINT(1) NOT NULL DEFAULT 0,  -- Menambahkan kolom is_important (0 = Tidak, 1 = Ya)
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (tbl_notes_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Menambahkan data awal ke tabel "users" (opsional)
INSERT INTO users (username, password, email) VALUES
('admin', 'admin_password_hash', 'admin@example.com');