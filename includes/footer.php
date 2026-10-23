    </main>

    <footer class="footer">
        <div class="container footer__grid">
            <div class="footer__brand">
                <?= avatar_html() ?>
                <div>
                    <p class="footer__name"><?= h($profil['nama']) ?></p>
                    <p class="footer__tagline"><?= h($profil['peran']) ?> · <?= h($profil['sekolah']) ?></p>
                </div>
            </div>
            <nav class="footer__nav" aria-label="Navigasi footer">
                <a href="<?= h(url('index.php')) ?>#tentang">Tentang</a>
                <a href="<?= h(url('proyek.php')) ?>">Proyek</a>
                <a href="<?= h(url('index.php')) ?>#keahlian">Keahlian</a>
                <a href="<?= h(url('index.php')) ?>#kontak">Kontak</a>
            </nav>
            <div class="footer__social">
                <a href="<?= h($profil['github']) ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub <?= h($profil['github_user']) ?>"><?= ikon('github', 18) ?></a>
                <a href="mailto:<?= h($profil['email']) ?>" aria-label="Kirim email"><?= ikon('mail', 18) ?></a>
            </div>
        </div>
        <div class="container footer__copy">
            © <?= date('Y') ?> <?= h($profil['nama']) ?>. <?= h($profil['tagline_footer']) ?>
        </div>
    </footer>

    <?php include __DIR__ . '/toast.php'; ?>
    <script src="<?= h(aset('js/script.js')) ?>" defer></script>
</body>
</html>
