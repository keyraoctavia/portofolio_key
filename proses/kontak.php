<?php
require_once __DIR__ . '/../includes/fungsi.php';
mulai_sesi();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    arahkan('index.php#kontak');
}

$kembali = 'index.php#kontak';

if (!csrf_valid()) {
    flash('galat', 'Sesi formulir sudah berakhir. Muat ulang halaman lalu coba lagi.');
    arahkan($kembali);
}

// Perangkap bot: kolom tersembunyi harus kosong, dan formulir tidak boleh dikirim terlalu cepat.
$waktu = (int) ($_POST['waktu'] ?? 0);
if (!empty($_POST['situs']) || $waktu <= 0 || (time() - $waktu) < KONTAK_MIN_DETIK) {
    flash('galat', 'Pesan tidak dapat dikirim. Coba lagi beberapa detik lagi.');
    arahkan($kembali);
}

// Batasi 1 pesan per 30 detik per sesi.
if (!empty($_SESSION['pesan_terakhir']) && (time() - $_SESSION['pesan_terakhir']) < 30) {
    flash('galat', 'Terlalu cepat. Tunggu sebentar sebelum mengirim pesan lagi.');
    arahkan($kembali);
}

$data = [
    'nama'   => trim((string) ($_POST['nama'] ?? '')),
    'email'  => trim((string) ($_POST['email'] ?? '')),
    'subjek' => trim((string) ($_POST['subjek'] ?? '')),
    'isi'    => trim((string) ($_POST['isi'] ?? '')),
];

$err = [];
if ($data['nama'] === '' || mb_strlen($data['nama']) > 100) { $err['nama'] = 'Nama wajib diisi (maksimal 100 karakter).'; }
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($data['email']) > 150) { $err['email'] = 'Masukkan alamat email yang valid.'; }
if ($data['subjek'] === '' || mb_strlen($data['subjek']) > 150) { $err['subjek'] = 'Subjek wajib diisi (maksimal 150 karakter).'; }
if (mb_strlen($data['isi']) < 10) { $err['isi'] = 'Pesan terlalu pendek (minimal 10 karakter).'; }
if (mb_strlen($data['isi']) > 3000) { $err['isi'] = 'Pesan terlalu panjang (maksimal 3000 karakter).'; }

if ($err) {
    flash('errors', $err);
    flash('old', $data);
    flash('galat', 'Periksa kembali isian formulir.');
    arahkan($kembali);
}

$pdo = db();
if (!$pdo) {
    flash('old', $data);
    flash('galat', 'Pesan belum bisa disimpan karena database belum aktif. Silakan kirim lewat email.');
    arahkan($kembali);
}

try {
    $st = $pdo->prepare('INSERT INTO pesan (nama, email, subjek, isi, ip) VALUES (:nama, :email, :subjek, :isi, :ip)');
    $st->execute([
        ':nama' => $data['nama'], ':email' => $data['email'], ':subjek' => $data['subjek'],
        ':isi' => $data['isi'], ':ip' => substr((string) ($_SERVER['REMOTE_ADDR'] ?? ''), 0, 45),
    ]);
} catch (Throwable $e) {
    error_log('Gagal menyimpan pesan: ' . $e->getMessage());
    flash('old', $data);
    flash('galat', 'Terjadi kesalahan saat menyimpan pesan. Silakan coba lagi nanti.');
    arahkan($kembali);
}

$_SESSION['pesan_terakhir'] = time();
flash('sukses', 'Terima kasih! Pesanmu sudah terkirim.');
arahkan($kembali);
