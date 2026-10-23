<?php
$beranda = $halamanBeranda ?? false;
$dasar   = $beranda ? '' : url('index.php');
$menu = [
    ['beranda', 'Beranda'],
    ['tentang', 'Tentang'],
    ['proyek', 'Proyek'],
    ['keahlian', 'Keahlian'],
    ['pendidikan', 'Pendidikan'],
    ['kontak', 'Kontak'],
];
?>
<header class="nav" data-nav>
    <div class="container nav__inner">
        <a href="<?= h($dasar) ?>#beranda" class="brand" aria-label="<?= h($profil['nama']) ?> — beranda">
            <?= avatar_html() ?>
            <span class="brand__name"><?= h($profil['nama']) ?></span>
        </a>

        <nav class="nav__links" aria-label="Navigasi utama">
            <?php foreach ($menu as [$id, $label]): ?>
                <a href="<?= h($dasar) ?>#<?= $id ?>" class="nav__link" data-nav-link="<?= $id ?>"><?= $label ?></a>
            <?php endforeach; ?>
        </nav>

        <button type="button" class="theme-toggle" data-theme-toggle aria-label="Ganti mode terang/gelap" title="Ganti mode terang/gelap">
            <?= ikon('moon', 18, 'theme-toggle__moon') ?><?= ikon('sun', 18, 'theme-toggle__sun') ?>
        </button>

        <a href="<?= h($dasar) ?>#kontak" class="btn btn--primary btn--sm nav__cta">Hubungi Saya</a>

        <button class="nav__toggle" type="button" aria-expanded="false" aria-controls="menu-mobile" data-menu-toggle>
            <span class="sr-only">Buka atau tutup menu</span>
            <span data-icon-open><?= ikon('menu') ?></span><span data-icon-close hidden><?= ikon('x') ?></span>
        </button>
    </div>

    <div class="mobile-menu" id="menu-mobile" data-mobile-menu>
        <nav class="container" aria-label="Navigasi mobile">
            <?php foreach ($menu as [$id, $label]): ?>
                <a href="<?= h($dasar) ?>#<?= $id ?>" class="mobile-menu__link" data-nav-link="<?= $id ?>"><?= $label ?></a>
            <?php endforeach; ?>
            <a href="<?= h($dasar) ?>#kontak" class="btn btn--primary">Hubungi Saya</a>
        </nav>
    </div>
</header>
