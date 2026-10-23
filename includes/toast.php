<?php
$sukses = flash('sukses');
$galat  = flash('galat');
if ($sukses || $galat): ?>
<div class="toast-stack" role="status" aria-live="polite">
    <?php if ($sukses): ?>
        <div class="toast toast--success" data-toast><span><?= h($sukses) ?></span><button type="button" class="toast__close" data-toast-close aria-label="Tutup"><?= ikon('x', 16) ?></button></div>
    <?php endif; ?>
    <?php if ($galat): ?>
        <div class="toast toast--error" data-toast><span><?= h($galat) ?></span><button type="button" class="toast__close" data-toast-close aria-label="Tutup"><?= ikon('x', 16) ?></button></div>
    <?php endif; ?>
</div>
<?php endif; ?>
