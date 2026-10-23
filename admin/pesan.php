<?php
require_once __DIR__ . '/_awal.php';

$pdo = db();
if (!$pdo) { arahkan('admin/index.php'); }
$id = (int) ($_GET['id'] ?? 0);

// Hapus pesan (POST + CSRF).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) { flash('galat', 'Sesi tidak valid. Coba lagi.'); arahkan('admin/index.php'); }
    $hapus = (int) ($_POST['id'] ?? 0);
    $st = $pdo->prepare('DELETE FROM pesan WHERE id = :id');
    $st->execute([':id' => $hapus]);
    flash('sukses', 'Pesan dihapus.');
    arahkan('admin/index.php');
}

$st = $pdo->prepare('SELECT * FROM pesan WHERE id = :id');
$st->execute([':id' => $id]);
$m = $st->fetch();
if (!$m) { http_response_code(404); flash('galat', 'Pesan tidak ditemukan.'); arahkan('admin/index.php'); }

if (!$m['dibaca_pada']) {
    $pdo->prepare('UPDATE pesan SET dibaca_pada = NOW() WHERE id = :id')->execute([':id' => $id]);
}

admin_kepala('Pesan dari ' . $m['nama'], 'pesan');
?>
<a class="link-arrow link-arrow--back" href="<?= h(url('admin/index.php')) ?>"><?= ikon('arrow-left', 16, 'link-arrow__icon') ?> Kembali ke kotak masuk</a>
<div class="adm-head" style="margin-top:18px"><div><h1><?= h($m['subjek']) ?></h1></div></div>
<div class="panel">
    <div class="msg-meta">
        <span><strong>Dari:</strong> <?= h($m['nama']) ?> &lt;<a href="mailto:<?= h($m['email']) ?>"><?= h($m['email']) ?></a>&gt;</span>
        <span><strong>Waktu:</strong> <?= h(date('d M Y H:i', strtotime($m['dibuat']))) ?></span>
        <?php if ($m['ip']): ?><span><strong>IP:</strong> <?= h($m['ip']) ?></span><?php endif; ?>
    </div>
    <div class="message-body"><?= nl2br(h($m['isi'])) ?></div>
    <div class="form-actions">
        <a class="btn btn--primary btn--sm" href="mailto:<?= h($m['email']) ?>?subject=<?= rawurlencode('Re: ' . $m['subjek']) ?>">Balas lewat email <?= ikon('mail', 15) ?></a>
        <form method="post" data-confirm="Hapus pesan ini secara permanen?">
            <?= csrf_input() ?><input type="hidden" name="id" value="<?= (int) $m['id'] ?>">
            <button class="btn btn--danger btn--sm" type="submit"><?= ikon('trash', 15) ?> Hapus</button>
        </form>
    </div>
</div>
<?php admin_kaki(); ?>
