<?php
require_once __DIR__ . '/_awal.php';

$pdo = db();
$pesan = [];
$total = 0;
$halaman = max(1, (int) ($_GET['hal'] ?? 1));
$per = 15;
$galat = null;

if ($pdo) {
    try {
        $total = (int) $pdo->query('SELECT COUNT(*) FROM pesan')->fetchColumn();
        $st = $pdo->prepare('SELECT id, nama, email, subjek, dibaca_pada, dibuat FROM pesan ORDER BY id DESC LIMIT :l OFFSET :o');
        $st->bindValue(':l', $per, PDO::PARAM_INT);
        $st->bindValue(':o', ($halaman - 1) * $per, PDO::PARAM_INT);
        $st->execute();
        $pesan = $st->fetchAll();
    } catch (Throwable $e) {
        $galat = 'Tabel pesan belum ada. Impor database/portfolio.sql terlebih dahulu.';
    }
} else {
    $galat = 'Tidak bisa terhubung ke database. Periksa config/database.php.';
}
$hal = max(1, (int) ceil($total / $per));

admin_kepala('Pesan Masuk', 'pesan');
?>
<div class="adm-head">
    <div><h1>Pesan Masuk</h1><p>Pesan dari formulir kontak di website. Total: <?= $total ?>.</p></div>
</div>

<?php if ($galat): ?>
    <div class="form__alert"><?= h($galat) ?></div>
<?php elseif (!$pesan): ?>
    <div class="empty"><span class="empty__icon"><?= ikon('inbox', 24) ?></span><p class="empty__title">Belum ada pesan</p><p class="empty__text">Pesan dari pengunjung akan muncul di sini.</p></div>
<?php else: ?>
    <div class="panel panel--flush">
        <?php foreach ($pesan as $m): ?>
            <a class="msg-row <?= $m['dibaca_pada'] ? '' : 'is-unread' ?>" href="<?= h(url('admin/pesan.php?id=' . (int) $m['id'])) ?>">
                <strong><?= h($m['nama']) ?></strong>
                <span><?= h($m['subjek']) ?> <small>— <?= h($m['email']) ?></small></span>
                <time datetime="<?= h($m['dibuat']) ?>"><?= h(date('d M Y H:i', strtotime($m['dibuat']))) ?></time>
            </a>
        <?php endforeach; ?>
    </div>
    <?php if ($hal > 1): ?>
        <nav class="pager" aria-label="Halaman">
            <?php if ($halaman > 1): ?><a class="pager__btn" href="?hal=<?= $halaman - 1 ?>">Sebelumnya</a><?php else: ?><span class="pager__btn is-disabled">Sebelumnya</span><?php endif; ?>
            <span class="pager__info">Halaman <?= $halaman ?> dari <?= $hal ?></span>
            <?php if ($halaman < $hal): ?><a class="pager__btn" href="?hal=<?= $halaman + 1 ?>">Berikutnya</a><?php else: ?><span class="pager__btn is-disabled">Berikutnya</span><?php endif; ?>
        </nav>
    <?php endif; ?>
<?php endif; ?>
<?php admin_kaki(); ?>
