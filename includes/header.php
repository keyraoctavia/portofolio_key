<?php
/**
 * Kepala halaman publik. Variabel yang bisa diisi sebelum include:
 *   $judulHalaman, $deskripsiHalaman, $gambarOg
 */
require_once __DIR__ . '/fungsi.php';
mulai_sesi(); // sesi harus dimulai sebelum ada output HTML
$profil   = konten();
$judul    = isset($judulHalaman) ? $judulHalaman . ' — ' . $profil['nama'] : NAMA_SITUS;
$deskripsi = $deskripsiHalaman ?? $profil['deskripsi_singkat'];
$ogImg    = $gambarOg ?? foto_profil();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($judul) ?></title>
    <meta name="description" content="<?= h(potong($deskripsi, 200)) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= h($judul) ?>">
    <meta property="og:description" content="<?= h(potong($deskripsi, 200)) ?>">
    <?php if ($ogImg): ?><meta property="og:image" content="<?= h($ogImg) ?>"><?php endif; ?>
    <meta name="color-scheme" content="light dark">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
    <script>(function(){var d=document.documentElement;d.classList.add('js');try{var t=localStorage.getItem('theme');if(!t){t=matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light'}d.dataset.theme=t}catch(e){}})();</script>
    <link rel="stylesheet" href="<?= h(aset('css/style.css')) ?>">
</head>
<body class="site">
    <a class="skip-link" href="#main">Lewati ke konten utama</a>
    <?php include __DIR__ . '/navbar.php'; ?>
    <main id="main">
