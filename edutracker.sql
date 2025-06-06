
CREATE DATABASE IF NOT EXISTS edutracker;
USE edutracker;

CREATE TABLE IF NOT EXISTS mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  no_telepon VARCHAR(20),
  tanggal_lahir DATE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS tugas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT NOT NULL,
  mata_kuliah VARCHAR(100) NOT NULL,
  deskripsi TEXT,
  jenis ENUM('Tugas Harian', 'Kuis', 'Tugas Besar', 'Project') NOT NULL,
  deadline DATE NOT NULL,
  status ENUM('Belum Selesai', 'Selesai') NOT NULL,
  FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS notifikasi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT NOT NULL,
  pesan TEXT NOT NULL,
  waktu DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id) ON DELETE CASCADE
);

-- Insert akun admin default (username: admin, password: admin123)
INSERT INTO admin (username, password)
VALUES ('admin', '$2y$10$rNOOJJx3j1sF1Shv2DYjCujbybZRA3gP2FZMXq9LBsphDY.cHxFIm');
-- Password 'admin123' yang sudah di-hash dengan PASSWORD_DEFAULT (bcrypt)
