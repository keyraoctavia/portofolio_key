<?php
/** Kartu proyek. Butuh variabel $p (satu proyek). */
$gbr = gambar_proyek($p['gambar'] ?? null);
$detail = url('detail-proyek.php') . '?slug=' . rawurlencode($p['slug']);
$jenisCfg = JENIS_PROYEK[$p['jenis']] ?? JENIS_PROYEK['website'];
$cari = mb_strtolower($p['judul'] . ' ' . $p['kategori'] . ' ' . $p['ringkasan'] . ' ' . implode(' ', $p['teknologi'] ?? []));
?>
<article class="pcard reveal" data-jenis="<?= h($p['jenis']) ?>" data-cari="<?= h($cari) ?>">
    <a class="pcard__media" href="<?= h($detail) ?>" aria-label="Lihat detail <?= h($p['judul']) ?>" tabindex="-1">
        <?php if ($gbr): ?>
            <img src="<?= h($gbr) ?>" alt="<?= h($p['alt'] ?: 'Tampilan proyek ' . $p['judul']) ?>" loading="lazy" width="1600" height="900">
        <?php else: ?>
            <div class="pcard__ph" role="img" aria-label="Gambar proyek belum tersedia">
                <span class="pcard__ph-mark"><?= h(mb_strtoupper(mb_substr($p['judul'], 0, 1))) ?></span>
                <small>Tampilan menyusul</small>
            </div>
        <?php endif; ?>
        <span class="pcard__open"><?= ikon('arrow-up-right', 18) ?></span>
    </a>
    <div class="pcard__body">
        <div class="pcard__status">
            <span class="badge badge--type"><?= h($jenisCfg['label']) ?></span>
            <?php if (!empty($p['akun_demo'])): ?><span class="badge badge--accent">Akun demo</span><?php endif; ?>
        </div>
        <h3 class="pcard__title"><a href="<?= h($detail) ?>"><?= h($p['judul']) ?></a></h3>
        <p class="pcard__summary"><?= h($p['ringkasan']) ?></p>
        <?php if (!empty($p['teknologi'])): ?>
            <ul class="chips" aria-label="Teknologi">
                <?php foreach ($p['teknologi'] as $t): ?><li class="chip"><?= h($t) ?></li><?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="pcard__actions">
            <a class="btn btn--primary btn--sm" href="<?= h($detail) ?>">Lihat Detail <?= ikon('arrow-right', 15, 'btn__icon') ?></a>
            <?php if (!empty($p['demo_url'])): ?>
                <a class="link-arrow" href="<?= h($p['demo_url']) ?>" target="_blank" rel="noopener noreferrer"><?= h($p['demo_label'] ?? $jenisCfg['tombol']) ?> <?= ikon('arrow-up-right', 15, 'link-arrow__icon') ?></a>
            <?php endif; ?>
            <?php if (!empty($p['repo_url'])): ?>
                <a class="link-arrow" href="<?= h($p['repo_url']) ?>" target="_blank" rel="noopener noreferrer"><?= ikon('github', 15) ?> Lihat Kode</a>
            <?php endif; ?>
        </div>
    </div>
</article>
