<?php
/**
 * Konfigurasi umum aplikasi.
 * File ini otomatis dimuat oleh includes/fungsi.php.
 */

// Folder utama proyek (satu tingkat di atas folder config).
define('ROOT_PATH', dirname(__DIR__));

// Nama situs (tampil di judul tab browser dan footer).
define('NAMA_SITUS', 'Keyra Oktaviani — Portofolio');

// Alamat dasar situs. Biarkan null agar terdeteksi otomatis (cocok untuk XAMPP, Laragon, maupun hosting).
// Kalau tautan/CSS tidak muncul, isi manual, contoh: '/portofolio' (tanpa garis miring di akhir) atau '' jika di root domain.
define('BASE_URL_MANUAL', null);

// Minimal detik pengisian formulir kontak (lebih cepat dianggap bot).
define('KONTAK_MIN_DETIK', 3);

// Zona waktu.
date_default_timezone_set('Asia/Jakarta');

// Tampilkan error PHP saat belajar/uji lokal. Ganti ke false saat sudah online.
define('TAMPILKAN_ERROR', false);
ini_set('display_errors', TAMPILKAN_ERROR ? '1' : '0');
error_reporting(E_ALL);
