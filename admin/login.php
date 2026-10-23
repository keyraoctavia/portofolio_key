<?php
require_once __DIR__ . '/../includes/fungsi.php';
mulai_sesi();
header('X-Robots-Tag: noindex, nofollow');

if (admin_login()) { arahkan('admin/index.php'); }

$galat = null;
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $sandi = (string) ($_POST['sandi'] ?? '');
    $sekarang = time();
    $_SESSION['gagal'] = array_values(array_filter($_SESSION['gagal'] ?? [], fn ($t) => $sekarang - $t < 600));

    if (!csrf_valid()) {
        $galat = 'Sesi formulir berakhir. Muat ulang halaman lalu coba lagi.';
    } elseif (count($_SESSION['gagal']) >= 5) {
        $galat = 'Terlalu banyak percobaan gagal. Tunggu beberapa menit lalu coba lagi.';
    } else {
        $pdo = db();
        $user = false;
        if ($pdo) {
            try {
                $st = $pdo->prepare('SELECT id, nama, kata_sandi FROM pengguna WHERE email = :e LIMIT 1');
                $st->execute([':e' => $email]);
                $user = $st->fetch();
            } catch (Throwable $e) { $user = false; }
        } else {
            $galat = 'Database belum aktif. Periksa config/database.php.';
        }
        if (!$galat) {
            // Selalu verifikasi hash agar waktu respons tidak membocorkan apakah email terdaftar.
            $hash = $user['kata_sandi'] ?? '$2y$10$usesomesillystringforsaltu0K8Hh4pS3m1y3o2wPz5r7jYQmLwG6';
            if ($user && password_verify($sandi, $hash)) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = (int) $user['id'];
                $_SESSION['admin_nama'] = $user['nama'];
                $_SESSION['gagal'] = [];
                arahkan('admin/index.php');
            }
            password_verify($sandi, $hash);
            $_SESSION['gagal'][] = $sekarang;
            $galat = 'Email atau kata sandi salah.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Masuk Admin — <?= h(konten('nama')) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=Playfair+Display:ital,wght@0,400;0,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= h(aset('css/style.css')) ?>">
</head>
<body class="site">
<div class="standalone">
    <div class="login">
        <span class="brand__mark"><?= h(konten('inisial')) ?></span>
        <h1 class="display display--sm">Masuk Admin</h1>
        <p class="lead">Khusus pemilik website untuk membaca pesan dari formulir kontak.</p>
        <?php if ($galat): ?><div class="form__alert" role="alert"><?= h($galat) ?></div><?php endif; ?>
        <form class="form" method="post" novalidate data-loading-form>
            <?= csrf_input() ?>
            <div class="field"><label for="email">Email</label><input class="input" id="email" name="email" type="email" required autocomplete="username" value="<?= h($email) ?>"></div>
            <div class="field"><label for="sandi">Kata sandi</label><input class="input" id="sandi" name="sandi" type="password" required autocomplete="current-password"></div>
            <button class="btn btn--primary btn--block" type="submit"><span class="spinner" aria-hidden="true"></span>Masuk</button>
        </form>
        <a class="link-arrow link-arrow--back" href="<?= h(url('index.php')) ?>"><?= ikon('arrow-left', 16, 'link-arrow__icon') ?> Kembali ke website</a>
    </div>
</div>
<script src="<?= h(aset('js/script.js')) ?>" defer></script>
</body>
</html>
