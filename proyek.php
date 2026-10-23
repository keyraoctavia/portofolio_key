<?php
require_once __DIR__ . '/includes/fungsi.php';
$judulHalaman = 'Semua Proyek';
$deskripsiHalaman = 'Kumpulan proyek website, desain UI/UX, dan game yang saya kerjakan.';

$semua = semua_proyek();
$jenisAktif = $_GET['jenis'] ?? 'semua';
$q = trim((string) ($_GET['q'] ?? ''));
if (!isset(JENIS_PROYEK[$jenisAktif])) { $jenisAktif = 'semua'; }

$jumlah = [];
foreach ($semua as $p) { $jumlah[$p['jenis']] = ($jumlah[$p['jenis']] ?? 0) + 1; }

$tampil = array_values(array_filter($semua, function ($p) use ($jenisAktif, $q) {
    if ($jenisAktif !== 'semua' && $p['jenis'] !== $jenisAktif) { return false; }
    if ($q !== '') {
        $gudang = mb_strtolower($p['judul'] . ' ' . $p['kategori'] . ' ' . $p['ringkasan'] . ' ' . implode(' ', $p['teknologi'] ?? []));
        if (mb_strpos($gudang, mb_strtolower($q)) === false) { return false; }
    }
    return true;
}));

include __DIR__ . '/includes/header.php';
?>
<section class="section catalog">
    <div class="container">
        <a class="link-arrow link-arrow--back" href="<?= h(url('index.php')) ?>#proyek"><?= ikon('arrow-left', 16, 'link-arrow__icon') ?> Kembali ke beranda</a>
        <div class="catalog__head">
            <p class="eyebrow">Portofolio</p>
            <h1 class="display display--sm">Semua proyek</h1>
            <p class="lead">Website, desain UI/UX, dan game yang pernah saya buat.</p>
        </div>

        <form class="catalog__bar" method="get" action="">
            <div class="searchfield">
                <?= ikon('search', 18) ?>
                <label class="sr-only" for="q">Cari proyek</label>
                <input class="input" id="q" type="search" name="q" value="<?= h($q) ?>" placeholder="Cari proyek, kategori, atau teknologi…">
            </div>
            <?php if ($jenisAktif !== 'semua'): ?><input type="hidden" name="jenis" value="<?= h($jenisAktif) ?>"><?php endif; ?>
            <button class="btn btn--ghost btn--sm" type="submit">Cari</button>
        </form>

        <div class="filters" role="group" aria-label="Filter jenis">
            <a class="filter <?= $jenisAktif === 'semua' ? 'is-active' : '' ?>" href="?<?= h(http_build_query(array_filter(['q' => $q]))) ?>">Semua <span class="typestrip__n"><?= count($semua) ?></span></a>
            <?php foreach ($jumlah as $j => $n): ?>
                <a class="filter <?= $jenisAktif === $j ? 'is-active' : '' ?>" href="?<?= h(http_build_query(array_filter(['jenis' => $j, 'q' => $q]))) ?>"><?= h(label_jenis($j)) ?> <span class="typestrip__n"><?= $n ?></span></a>
            <?php endforeach; ?>
        </div>

        <p class="catalog__count"><?= count($tampil) ?> proyek ditemukan</p>

        <?php if ($tampil): ?>
            <div class="pgrid">
                <?php foreach ($tampil as $p) { include __DIR__ . '/includes/kartu-proyek.php'; } ?>
            </div>
        <?php else: ?>
            <div class="empty">
                <span class="empty__icon"><?= ikon('search', 24) ?></span>
                <p class="empty__title">Proyek tidak ditemukan</p>
                <p class="empty__text">Coba kata kunci lain atau tampilkan semua jenis.</p>
                <a class="btn btn--ghost btn--sm" href="<?= h(url('proyek.php')) ?>">Reset pencarian</a>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
