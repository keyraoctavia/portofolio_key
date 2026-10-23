<?php
/**
 * Pengaturan koneksi MySQL (dipakai untuk pesan kontak dan login admin).
 * Halaman publik tetap bisa dibuka walaupun database belum disiapkan.
 *
 * Laragon / XAMPP bawaan: user "root", password kosong.
 * Hosting: isi sesuai data dari panel hosting.
 */
return [
    'host'     => '127.0.0.1',
    'port'     => 3306,
    'nama_db'  => 'portofolio_keyra',
    'pengguna' => 'root',
    'sandi'    => '',
    'charset'  => 'utf8mb4',
];
