<?php
require_once __DIR__ . '/includes/fungsi.php';
$halamanBeranda = true;
include __DIR__ . '/includes/header.php';

$cv        = dokumen('cv');
$transkrip = dokumen('transkrip');
$foto      = foto_profil();
$unggulan  = array_values(array_filter(semua_proyek(), fn ($p) => !empty($p['unggulan'])));
$jumlahJenis = [];
foreach ($unggulan as $p) { $jumlahJenis[$p['jenis']] = ($jumlahJenis[$p['jenis']] ?? 0) + 1; }
$old = flash('old') ?? [];
$errors = flash('errors') ?? [];
?>
<!-- ===================== BERANDA ===================== -->
<section id="beranda" class="hero" data-section="beranda">
    <div class="container hero__grid">
        <div class="hero__copy">
            <p class="pill pill--learning hero-in" style="--d:0ms"><span class="pill__dot" aria-hidden="true"></span><?= h($profil['status']) ?></p>
            <p class="eyebrow hero-in" style="--d:80ms"><?= h($profil['peran']) ?> · <?= h($profil['sekolah']) ?></p>
            <h1 class="display hero-in" style="--d:160ms"><?= h($profil['judul_utama']) ?> <em><?= h($profil['judul_aksen']) ?></em></h1>
            <p class="hero__name hero-in" style="--d:220ms"><?= h($profil['nama']) ?></p>
            <p class="lead hero-in" style="--d:280ms"><?= h($profil['deskripsi_singkat']) ?></p>

            <div class="hero__actions hero-in" style="--d:360ms">
                <a href="#proyek" class="btn btn--primary">Lihat Proyek <?= ikon('arrow-down', 16, 'btn__icon') ?></a>
                <?php if ($cv['ada']): ?>
                    <a href="<?= h($cv['url']) ?>" class="btn btn--ghost" target="_blank" rel="noopener noreferrer">Lihat CV <?= ikon('eye', 16, 'btn__icon') ?></a>
                <?php endif; ?>
                <a href="<?= h($profil['github']) ?>" class="btn btn--ghost" target="_blank" rel="noopener noreferrer"><?= ikon('github', 16) ?> Lihat GitHub</a>
            </div>
            <p class="hero__more hero-in" style="--d:420ms">
                <?php if ($cv['ada']): ?><a class="link-arrow" href="<?= h($cv['url']) ?>" download>Unduh CV <?= ikon('download', 15, 'link-arrow__icon') ?></a><?php endif; ?>
                <?php if ($transkrip['ada']): ?>
                    <a class="link-arrow" href="<?= h($transkrip['url']) ?>" target="_blank" rel="noopener noreferrer">Lihat Transkrip Nilai <?= ikon('arrow-up-right', 15, 'link-arrow__icon') ?></a>
                <?php endif; ?>
            </p>
        </div>

        <div class="hero__media hero-in" style="--d:200ms">
            <figure class="portrait">
                <?php if ($foto): ?>
                    <img src="<?= h($foto) ?>" alt="Foto <?= h($profil['nama']) ?>" width="720" height="900" fetchpriority="high">
                <?php else: ?>
                    <div class="portrait__fallback" role="img" aria-label="Inisial <?= h($profil['nama']) ?>"><span><?= h($profil['inisial']) ?></span></div>
                <?php endif; ?>
                <figcaption class="portrait__badge"><span class="pill__dot" aria-hidden="true"></span><?= h($profil['lencana']) ?></figcaption>
            </figure>
        </div>
    </div>
</section>

<!-- ===================== TENTANG ===================== -->
<section id="tentang" class="section section--tint" data-section="tentang">
    <div class="container about">
        <div class="about__intro reveal">
            <p class="eyebrow">Tentang Saya</p>
            <h2 class="title"><?= h($profil['tentang_judul']) ?></h2>
            <div class="prose">
                <?php foreach ($profil['tentang'] as $para): ?><p><?= h($para) ?></p><?php endforeach; ?>
            </div>
        </div>
        <ol class="principles reveal">
            <?php foreach ($profil['sorotan'] as $i => $s): ?>
                <li class="principle">
                    <span class="principle__no"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <div><h3><?= h($s['judul']) ?></h3><p><?= h($s['isi']) ?></p></div>
                    <span class="principle__icon"><?= ikon($s['ikon'], 26) ?></span>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<!-- ===================== PROYEK ===================== -->
<section id="proyek" class="section" data-section="proyek">
    <div class="container">
        <div class="section__head reveal">
            <div>
                <p class="eyebrow">Portofolio</p>
                <h2 class="title">Proyek yang pernah saya kerjakan.</h2>
            </div>
            <span class="section__meta"><?= count($unggulan) ?> PILIHAN</span>
        </div>

        <div class="filters filters--types" role="group" aria-label="Filter jenis portofolio">
            <button type="button" class="filter is-active" data-filter="semua">Semua <span class="typestrip__n"><?= count($unggulan) ?></span></button>
            <?php foreach ($jumlahJenis as $j => $n): ?>
                <button type="button" class="filter" data-filter="<?= h($j) ?>"><?= h(label_jenis($j)) ?> <span class="typestrip__n"><?= $n ?></span></button>
            <?php endforeach; ?>
        </div>

        <div class="pgrid" data-grid>
            <?php foreach ($unggulan as $p) { include __DIR__ . '/includes/kartu-proyek.php'; } ?>
        </div>

        <div class="section__cta reveal">
            <a class="btn btn--ghost" href="<?= h(url('proyek.php')) ?>">Lihat Semua Proyek <?= ikon('arrow-right', 16, 'btn__icon') ?></a>
        </div>
    </div>
</section>

<!-- ===================== KEAHLIAN ===================== -->
<section id="keahlian" class="section section--tint" data-section="keahlian">
    <div class="container">
        <div class="section__head reveal">
            <div>
                <p class="eyebrow">Keahlian</p>
                <h2 class="title">Yang sudah dan sedang saya pelajari.</h2>
            </div>
        </div>
        <div class="skill-groups">
            <?php foreach ($profil['keahlian'] as $g): ?>
                <div class="skill-group reveal">
                    <h3 class="skill-group__title"><?= h($g['kelompok']) ?></h3>
                    <ul class="tags">
                        <?php foreach ($g['daftar'] as $s): ?>
                            <li class="tag <?= in_array($s, $g['utama'] ?? [], true) ? 'tag--accent' : '' ?>"><?= h($s) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="meters reveal">
            <div>
                <h3 class="skill-group__title">Keterampilan Pribadi</h3>
                <ul class="meter-list">
                    <?php foreach ($profil['keterampilan'] as $k): ?>
                        <li class="meter">
                            <span class="meter__label"><?= h($k['nama']) ?></span>
                            <span class="meter__bar" role="img" aria-label="<?= (int) $k['nilai'] ?> dari 10"><i style="--v:<?= (int) $k['nilai'] * 10 ?>%"></i></span>
                            <span class="meter__val"><?= (int) $k['nilai'] ?>/10</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <h3 class="skill-group__title">Bahasa</h3>
                <ul class="meter-list">
                    <?php foreach ($profil['bahasa'] as $k): ?>
                        <li class="meter">
                            <span class="meter__label"><?= h($k['nama']) ?></span>
                            <span class="meter__bar" role="img" aria-label="<?= (int) $k['nilai'] ?> dari 10"><i style="--v:<?= (int) $k['nilai'] * 10 ?>%"></i></span>
                            <span class="meter__val"><?= (int) $k['nilai'] ?>/10</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ===================== PENDIDIKAN, ORGANISASI, DOKUMEN ===================== -->
<section id="pendidikan" class="section" data-section="pendidikan">
    <div class="container">
        <div class="section__head reveal">
            <div>
                <p class="eyebrow">Pendidikan &amp; Pengalaman</p>
                <h2 class="title">Perjalanan belajar saya.</h2>
            </div>
        </div>

        <ol class="timeline reveal">
            <?php foreach ($profil['pendidikan'] as $e): ?>
                <li class="timeline__item">
                    <span class="timeline__dot" aria-hidden="true"></span>
                    <p class="eyebrow"><?= h($e['tahun']) ?></p>
                    <h3 class="timeline__title"><?= h($e['sekolah']) ?></h3>
                    <?php if ($e['jurusan']): ?><p class="timeline__org"><?= h($e['jurusan']) ?></p><?php endif; ?>
                    <?php if ($e['catatan']): ?><p class="timeline__text"><?= h($e['catatan']) ?></p><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>

        <?php foreach ($profil['organisasi'] as $o): ?>
            <div class="education--spaced reveal">
                <p class="eyebrow">Pengalaman Organisasi · <?= h($o['tahun']) ?></p>
                <h3 class="title title--sm"><?= h($o['nama']) ?></h3>
                <ul class="feature-list" style="margin-top:18px">
                    <?php foreach ($o['poin'] as $pt): ?><li><?= ikon('check', 18) ?><span><?= h($pt) ?></span></li><?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>

        <div class="docs education--spaced reveal" id="dokumen">
            <?php foreach (['cv' => $cv, 'transkrip' => $transkrip] as $kunci => $d): ?>
                <div class="doc">
                    <span class="doc__icon"><?= ikon($kunci === 'cv' ? 'file' : 'grad', 34) ?></span>
                    <div>
                        <h3><?= h($d['judul']) ?></h3>
                        <p><?= h($d['keterangan']) ?></p>
                        <?php if ($d['ada']): ?><p class="doc__meta">PDF · <?= h($d['ukuran']) ?></p><?php endif; ?>
                    </div>
                    <div class="doc__actions">
                        <?php if ($d['ada']): ?>
                            <a class="btn btn--primary btn--sm" href="<?= h($d['url']) ?>" target="_blank" rel="noopener noreferrer"><?= $kunci === 'cv' ? 'Lihat CV' : 'Lihat Transkrip Nilai' ?> <?= ikon('eye', 15, 'btn__icon') ?></a>
                            <a class="btn btn--ghost btn--sm" href="<?= h($d['url']) ?>" download><?= $kunci === 'cv' ? 'Unduh CV' : 'Unduh Transkrip' ?> <?= ikon('download', 15) ?></a>
                        <?php else: ?>
                            <span class="btn btn--ghost btn--sm is-disabled" aria-disabled="true"><?= h($d['judul']) ?> segera tersedia</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== KONTAK ===================== -->
<section id="kontak" class="section section--tint" data-section="kontak">
    <div class="container contact__grid">
        <div class="contact__intro reveal">
            <p class="eyebrow">Kontak</p>
            <h2 class="title">Mau ngobrol atau berkolaborasi?</h2>
            <p class="lead">Kirim pesan lewat formulir ini atau hubungi saya lewat tautan di bawah. Saya akan membalas secepatnya.</p>
            <ul class="social-list">
                <li><a class="social-link" href="mailto:<?= h($profil['email']) ?>"><?= ikon('mail', 22) ?><span><strong>Email</strong><small><?= h($profil['email']) ?></small></span><?= ikon('arrow-up-right', 18, 'social-link__go') ?></a></li>
                <li><a class="social-link" href="<?= h($profil['github']) ?>" target="_blank" rel="noopener noreferrer"><?= ikon('github', 22) ?><span><strong>GitHub</strong><small><?= h($profil['github_user']) ?></small></span><?= ikon('arrow-up-right', 18, 'social-link__go') ?></a></li>
                <li class="social-link"><?= ikon('map', 22) ?><span><strong>Lokasi</strong><small><?= h($profil['lokasi']) ?></small></span></li>
            </ul>
        </div>

        <form class="form reveal" method="post" action="<?= h(url('proses/kontak.php')) ?>" novalidate data-loading-form>
            <?= csrf_input() ?>
            <input type="hidden" name="waktu" value="<?= time() ?>">
            <div class="hp" aria-hidden="true"><label>Jangan diisi<input type="text" name="situs" tabindex="-1" autocomplete="off"></label></div>

            <div class="form__row">
                <div class="field">
                    <label for="nama">Nama <span class="req">*</span></label>
                    <input class="input <?= isset($errors['nama']) ? 'is-invalid' : '' ?>" id="nama" name="nama" type="text" maxlength="100" required value="<?= h($old['nama'] ?? '') ?>" autocomplete="name">
                    <?php if (isset($errors['nama'])): ?><p class="field__error"><?= h($errors['nama']) ?></p><?php endif; ?>
                </div>
                <div class="field">
                    <label for="email">Email <span class="req">*</span></label>
                    <input class="input <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" type="email" maxlength="150" required value="<?= h($old['email'] ?? '') ?>" autocomplete="email">
                    <?php if (isset($errors['email'])): ?><p class="field__error"><?= h($errors['email']) ?></p><?php endif; ?>
                </div>
            </div>
            <div class="field">
                <label for="subjek">Subjek <span class="req">*</span></label>
                <input class="input <?= isset($errors['subjek']) ? 'is-invalid' : '' ?>" id="subjek" name="subjek" type="text" maxlength="150" required value="<?= h($old['subjek'] ?? '') ?>">
                <?php if (isset($errors['subjek'])): ?><p class="field__error"><?= h($errors['subjek']) ?></p><?php endif; ?>
            </div>
            <div class="field">
                <label for="isi">Pesan <span class="req">*</span></label>
                <textarea class="input <?= isset($errors['isi']) ? 'is-invalid' : '' ?>" id="isi" name="isi" rows="6" maxlength="3000" required><?= h($old['isi'] ?? '') ?></textarea>
                <?php if (isset($errors['isi'])): ?><p class="field__error"><?= h($errors['isi']) ?></p><?php endif; ?>
            </div>
            <button type="submit" class="btn btn--primary btn--block"><span class="spinner" aria-hidden="true"></span>Kirim Pesan <?= ikon('send', 16) ?></button>
        </form>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
