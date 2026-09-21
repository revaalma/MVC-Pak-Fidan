-- Struktur ulang database db_catatan
-- Disusun dari AdminModel, KategoriModel, CatatanModel dan config/database.php
-- Catatan: tipe data & panjang kolom adalah perkiraan (tidak tertulis di kode).
-- Hanya struktur; isi data tidak ikut kembali.

CREATE DATABASE IF NOT EXISTS db_catatan
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE db_catatan;

-- Tabel admin (register, login)
CREATE TABLE IF NOT EXISTS admin (
  id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username  VARCHAR(50)  NOT NULL,
  password  VARCHAR(255) NOT NULL,  -- hasil password_hash(), butuh 255
  PRIMARY KEY (id),
  UNIQUE KEY uq_admin_username (username)
) ENGINE=InnoDB;

-- Tabel kategori
CREATE TABLE IF NOT EXISTS kategori (
  id             INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama_kategori  VARCHAR(100) NOT NULL,
  admin_id       INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  KEY idx_kategori_admin (admin_id),
  CONSTRAINT fk_kategori_admin
    FOREIGN KEY (admin_id) REFERENCES admin (id)
) ENGINE=InnoDB;

-- Tabel catatan
-- kategori_id boleh NULL (model mengisi NULL jika kategori kosong)
CREATE TABLE IF NOT EXISTS catatan (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  judul        VARCHAR(255) NOT NULL,
  isi          TEXT         NOT NULL,
  kategori_id  INT UNSIGNED NULL,
  admin_id     INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  KEY idx_catatan_kategori (kategori_id),
  KEY idx_catatan_admin (admin_id),
  CONSTRAINT fk_catatan_kategori
    FOREIGN KEY (kategori_id) REFERENCES kategori (id)
    ON DELETE SET NULL,
  CONSTRAINT fk_catatan_admin
    FOREIGN KEY (admin_id) REFERENCES admin (id)
) ENGINE=InnoDB;