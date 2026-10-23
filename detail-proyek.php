<?php
require_once __DIR__ . '/includes/fungsi.php';

$p = cari_proyek((string) ($_GET['slug'] ?? ''));
if (!$p) {
    http_response_code(404);
    $judulHalaman = 'Proyek tidak ditemukan';
    include __DIR__ . '/includes/header.php';
    ?>
    <section class="section"><div class="container container--narrow">
        <div class="empty">
            <span class="empty__icon"><?= ikon('search', 24) ?></span>
            <p class="empty__title">Proyek tidak ditemukan</p>
            <p class="empty__text">Tautan yang kamu buka mungkin salah atau proyeknya sudah dihapus.</p>
            <a class="btn btn--primary btn--sm" href="<?= h(url('proyek.php')) ?>">Lihat semua proyek</a>
        </div>
    </div></section>
    <?php
    include __DIR__ . '/includes/footer.php';
    exit;
}

$cfg = JENIS_PROYEK[$p['jenis']] ?? JENIS_PROYEK['website'];
$gbr = gambar_proyek($p['gambar'] ?? null);
$judulHalaman = $p['judul'];
$deskripsiHalaman = $p['ringkasan'];
$gambarOg = $gbr;

// Proyek lain (selain yang ini, prioritas jenis sama).
$lain = array_values(array_filter(semua_proyek(), fn ($x) => $x['slug'] !== $p['slug']));
usort($lain, fn ($a, $b) => ($b['jenis'] === $p['jenis']) <=> ($a['jenis'] === $p['jenis']));
$lain = array_slice($lain, 0, 3);

include __DIR__ . '/includes/header.php';
?>
<article class="section project-detail">
    <div class="container">
        <a class="link-arrow link-arrow--back" href="<?= h(url('proyek.php')) ?>"><?= ikon('arrow-left', 16, 'link-arrow__icon') ?> Semua proyek</a>

        <header class="project-detail__head">
            <p class="eyebrow"><?= h($cfg['label']) ?> · <?= h($p['kategori']) ?></p>
            <h1 class="display display--sm"><?= h($p['judul']) ?></h1>
            <p class="lead"><?= h($p['ringkasan']) ?></p>

            <div class="hero__actions" style="margin-top:28px">
                <?php if (!empty($p['demo_url'])): ?>
                    <a class="btn btn--primary" href="<?= h($p['demo_url']) ?>" target="_blank" rel="noopener noreferrer"><?= h($p['demo_label'] ?? $cfg['tombol']) ?> <?= ikon('arrow-up-right', 16, 'btn__icon') ?></a>
                <?php endif; ?>
                <?php if (!empty($p['repo_url'])): ?>
                    <a class="btn btn--ghost" href="<?= h($p['repo_url']) ?>" target="_blank" rel="noopener noreferrer"><?= ikon('github', 16) ?> Lihat Kode di GitHub</a>
                <?php endif; ?>
            </div>
        </header>

        <dl class="meta">
            <div><dt>Jenis</dt><dd><?= h($cfg['label']) ?></dd></div>
            <?php if (!empty($p['peran'])): ?><div><dt>Peran saya</dt><dd><?= h($p['peran']) ?></dd></div><?php endif; ?>
            <?php if (!empty($p['platform'])): ?><div><dt>Platform</dt><dd><?= h($p['platform']) ?></dd></div><?php endif; ?>
            <?php if (!empty($p['status'])): ?><div><dt>Status</dt><dd><span class="badge badge--completed"><?= h($p['status']) ?></span></dd></div><?php endif; ?>
            <?php if (!empty($p['teknologi'])): ?>
                <div><dt><?= h($cfg['alat']) ?></dt><dd><ul class="chips"><?php foreach ($p['teknologi'] as $t): ?><li class="chip"><?= h($t) ?></li><?php endforeach; ?></ul></dd></div>
            <?php endif; ?>
        </dl>

        <?php if ($gbr): ?>
            <img class="project-detail__cover" src="<?= h($gbr) ?>" alt="<?= h($p['alt'] ?: 'Tampilan ' . $p['judul']) ?>" width="1600" height="900">
        <?php else: ?>
            <div class="pcard__ph project-detail__cover--ph" role="img" aria-label="Gambar proyek belum tersedia"><span class="pcard__ph-mark"><?= h(mb_strtoupper(mb_substr($p['judul'], 0, 1))) ?></span><small>Tampilan menyusul</small></div>
        <?php endif; ?>

        <div class="project-detail__body">
            <?php if (!empty($p['deskripsi'])): ?>
                <section>
                    <h2 class="title title--sm">Tentang proyek ini</h2>
                    <div class="prose"><?php foreach ((array) $p['deskripsi'] as $para): ?><p><?= h($para) ?></p><?php endforeach; ?></div>
                </section>
            <?php endif; ?>

            <?php if (!empty($p['tujuan'])): ?>
                <section>
                    <h2 class="title title--sm">Tujuan</h2>
                    <p class="prose-p"><?= h($p['tujuan']) ?></p>
                </section>
            <?php endif; ?>

            <?php if (!empty($p['fitur'])): ?>
                <section>
                    <h2 class="title title--sm">Fitur utama</h2>
                    <ul class="feature-list"><?php foreach ($p['fitur'] as $f): ?><li><?= ikon('check', 18) ?><span><?= h($f) ?></span></li><?php endforeach; ?></ul>
                </section>
            <?php endif; ?>

            <?php if (!empty($p['akun_demo'])): ?>
                <section id="akun-demo">
                    <h2 class="title title--sm">Akun demo</h2>
                    <p class="prose-p">Aplikasi ini memakai login dengan beberapa akun. Gunakan salah satu akun di bawah untuk mencoba aplikasinya, lalu masuk lewat tombol <strong><?= h($p['demo_label'] ?? 'Buka Halaman Login') ?></strong>.</p>
                    <div class="table-wrap demo-accounts">
                        <table class="table">
                            <thead><tr><th>Peran</th><th>Nama</th><th>Email</th><th>Kata sandi</th></tr></thead>
                            <tbody>
                            <?php foreach ($p['akun_demo'] as $a): ?>
                                <tr>
                                    <td><span class="badge badge--type" style="margin:0"><?= h($a['peran']) ?></span></td>
                                    <td><?= h($a['nama']) ?></td>
                                    <td><code><?= h($a['email']) ?></code></td>
                                    <td><code><?= h($a['sandi']) ?></code></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <p class="field__help" style="margin-top:12px">Akun ini khusus untuk demo/uji coba, bukan akun data asli.</p>
                </section>
            <?php endif; ?>
        </div>

        <?php if (!empty($p['galeri'])): ?>
            <div class="gallery-wrap">
                <h2 class="title title--sm"><?= $p['jenis'] === 'uiux' ? 'Layar desain' : 'Galeri' ?></h2>
                <div class="gallery <?= $p['jenis'] === 'uiux' ? 'gallery--phones' : '' ?>">
                    <?php foreach ($p['galeri'] as $g): $u = gambar_proyek($g['berkas']); if (!$u) continue; ?>
                        <figure>
                            <a href="<?= h($u) ?>" target="_blank" rel="noopener noreferrer" class="gallery__link" title="Buka ukuran penuh">
                                <img src="<?= h($u) ?>" alt="<?= h($g['keterangan']) ?>" loading="lazy">
                            </a>
                            <figcaption><?= h($g['keterangan']) ?></figcaption>
                        </figure>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($p['logo'])): ?>
            <div class="gallery-wrap">
                <h2 class="title title--sm">Identitas visual</h2>
                <div class="gallery gallery--logos">
                    <?php foreach ($p['logo'] as $g): $u = gambar_proyek($g['berkas']); if (!$u) continue; ?>
                        <figure><div class="logo-box"><img src="<?= h($u) ?>" alt="<?= h($g['keterangan']) ?>" loading="lazy"></div><figcaption><?= h($g['keterangan']) ?></figcaption></figure>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($lain): ?>
            <div class="related">
                <h2 class="title title--sm">Proyek lainnya</h2>
                <div class="pgrid"><?php foreach ($lain as $p) { include __DIR__ . '/includes/kartu-proyek.php'; } ?></div>
            </div>
        <?php endif; ?>
    </div>
</article>
<?php include __DIR__ . '/includes/footer.php'; ?>
