<?php
/** Pembuka halaman admin: memuat fungsi, memeriksa login, menampilkan kerangka. */
require_once __DIR__ . '/../includes/fungsi.php';
mulai_sesi();
wajib_admin();
header('X-Robots-Tag: noindex, nofollow');

function admin_kepala(string $judul, string $aktif = 'pesan'): void
{
    $pdo = db();
    $belum = 0;
    if ($pdo) {
        try { $belum = (int) $pdo->query('SELECT COUNT(*) FROM pesan WHERE dibaca_pada IS NULL')->fetchColumn(); } catch (Throwable $e) {}
    }
    ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title><?= h($judul) ?> — Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=Playfair+Display:ital,wght@0,400;0,500;0,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= h(aset('css/style.css')) ?>">
</head>
<body class="adm adm-body">
<aside class="adm-side" data-admin-side>
    <div class="adm-side__top">
        <span class="brand__mark"><?= h(konten('inisial')) ?></span>
        <div><div class="adm-side__title">Panel Admin</div><div class="adm-side__sub">Portofolio</div></div>
    </div>
    <nav class="adm-nav" aria-label="Menu admin">
        <a class="adm-nav__link <?= $aktif === 'pesan' ? 'is-active' : '' ?>" href="<?= h(url('admin/index.php')) ?>"><?= ikon('inbox', 18) ?> Pesan Masuk <?php if ($belum): ?><span class="adm-count"><?= $belum ?></span><?php endif; ?></a>
        <a class="adm-nav__link" href="<?= h(url('index.php')) ?>" target="_blank" rel="noopener"><?= ikon('eye', 18) ?> Lihat Website</a>
    </nav>
    <div class="adm-side__bottom">
        <form method="post" action="<?= h(url('admin/keluar.php')) ?>"><?= csrf_input() ?><button class="adm-nav__link adm-nav__link--btn" type="submit"><?= ikon('logout', 18) ?> Keluar</button></form>
    </div>
</aside>
<div class="adm-backdrop" data-admin-backdrop></div>
<div class="adm-main">
    <div class="adm-top">
        <button class="adm-top__menu" type="button" data-admin-toggle aria-label="Buka menu"><?= ikon('menu', 20) ?></button>
        <span class="adm-top__user"><?= h($_SESSION['admin_nama'] ?? 'Admin') ?></span>
    </div>
    <main class="adm-content">
<?php
}

function admin_kaki(): void
{
    ?>
    </main>
</div>
<?php include __DIR__ . '/../includes/toast.php'; ?>
<script src="<?= h(aset('js/script.js')) ?>" defer></script>
</body>
</html>
<?php
}
