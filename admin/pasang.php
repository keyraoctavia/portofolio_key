<?php
/**
 * PEMASANGAN SEKALI: membuat akun admin pertama.
 * Halaman ini hanya bisa dipakai kalau tabel `pengguna` masih kosong.
 * Setelah akun dibuat, HAPUS file ini dari server (lebih aman).
 */
require_once __DIR__ . '/../includes/fungsi.php';
mulai_sesi();
header('X-Robots-Tag: noindex, nofollow');

$pdo = db();
$sudah = false;
$galat = null;
$sukses = false;
$nama = ''; $email = '';

if (!$pdo) {
    $galat = 'Tidak bisa terhubung ke database. Impor database/portfolio.sql dan periksa config/database.php.';
} else {
    try {
        $sudah = (int) $pdo->query('SELECT COUNT(*) FROM pengguna')->fetchColumn() > 0;
    } catch (Throwable $e) {
        $galat = 'Tabel belum ada. Impor database/portfolio.sql terlebih dahulu.';
    }
}

if (!$galat && !$sudah && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim((string) ($_POST['nama'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $sandi = (string) ($_POST['sandi'] ?? '');
    if (!csrf_valid()) {
        $galat = 'Sesi formulir berakhir. Muat ulang halaman.';
    } elseif ($nama === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $galat = 'Isi nama dan email yang valid.';
    } elseif (mb_strlen($sandi) < 10) {
        $galat = 'Kata sandi minimal 10 karakter.';
    } else {
        $st = $pdo->prepare('INSERT INTO pengguna (nama, email, kata_sandi) VALUES (:n, :e, :p)');
        $st->execute([':n' => $nama, ':e' => $email, ':p' => password_hash($sandi, PASSWORD_DEFAULT)]);
        $sukses = true;
        $sudah = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Pasang Admin — <?= h(konten('nama')) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=Playfair+Display:ital,wght@0,400;0,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= h(aset('css/style.css')) ?>">
</head>
<body class="site">
<div class="standalone"><div class="login">
    <h1 class="display display--sm">Pasang Admin</h1>
    <?php if ($sukses): ?>
        <div class="form__ok">Akun admin berhasil dibuat. Sekarang hapus file <code>admin/pasang.php</code> dari server, lalu masuk.</div>
        <a class="btn btn--primary" href="<?= h(url('admin/login.php')) ?>">Ke halaman masuk</a>
    <?php elseif ($sudah): ?>
        <div class="form__alert">Admin sudah terpasang, jadi halaman ini dinonaktifkan. Hapus file <code>admin/pasang.php</code>.</div>
        <a class="btn btn--ghost" href="<?= h(url('admin/login.php')) ?>">Ke halaman masuk</a>
    <?php else: ?>
        <p class="lead">Buat akun admin pertama untuk membaca pesan kontak.</p>
        <?php if ($galat): ?><div class="form__alert" role="alert"><?= h($galat) ?></div><?php endif; ?>
        <?php if ($pdo && !str_contains((string) $galat, 'Tabel belum')): ?>
        <form class="form" method="post" novalidate>
            <?= csrf_input() ?>
            <div class="field"><label for="nama">Nama</label><input class="input" id="nama" name="nama" required value="<?= h($nama) ?>"></div>
            <div class="field"><label for="email">Email</label><input class="input" id="email" name="email" type="email" required value="<?= h($email) ?>"></div>
            <div class="field"><label for="sandi">Kata sandi (min. 10 karakter)</label><input class="input" id="sandi" name="sandi" type="password" minlength="10" required autocomplete="new-password"></div>
            <button class="btn btn--primary btn--block" type="submit">Buat Admin</button>
        </form>
        <?php endif; ?>
    <?php endif; ?>
</div></div>
</body>
</html>
