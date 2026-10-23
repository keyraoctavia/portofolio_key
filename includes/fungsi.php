<?php
/**
 * Fungsi bantu yang dipakai di semua halaman.
 */
require_once __DIR__ . '/../config/app.php';

/* ---------------- Sesi ---------------- */
function mulai_sesi(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    ]);
    session_start();
}

/* ---------------- Keluaran aman ---------------- */
function h($teks): string
{
    return htmlspecialchars((string) $teks, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/* ---------------- URL ---------------- */
function base_url(): string
{
    static $base = null;
    if ($base !== null) {
        return $base;
    }
    if (BASE_URL_MANUAL !== null) {
        return $base = rtrim((string) BASE_URL_MANUAL, '/');
    }
    $docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '') ?: '';
    $root    = realpath(ROOT_PATH) ?: ROOT_PATH;
    $docRoot = str_replace('\\', '/', $docRoot);
    $root    = str_replace('\\', '/', $root);
    if ($docRoot !== '' && strpos($root, $docRoot) === 0) {
        return $base = rtrim(substr($root, strlen($docRoot)), '/');
    }
    return $base = '';
}

function url(string $path = ''): string
{
    return base_url() . '/' . ltrim($path, '/');
}

function aset(string $path): string
{
    return url('assets/' . ltrim($path, '/'));
}

function arahkan(string $path): void
{
    header('Location: ' . (preg_match('#^https?://#', $path) ? $path : url($path)));
    exit;
}

/* ---------------- Data ---------------- */
function konten(?string $kunci = null)
{
    static $data = null;
    if ($data === null) {
        $data = require ROOT_PATH . '/config/konten.php';
    }
    return $kunci === null ? $data : ($data[$kunci] ?? null);
}

function semua_proyek(): array
{
    static $data = null;
    if ($data === null) {
        $data = require ROOT_PATH . '/config/proyek.php';
    }
    return $data;
}

function cari_proyek(string $slug): ?array
{
    foreach (semua_proyek() as $p) {
        if ($p['slug'] === $slug) {
            return $p;
        }
    }
    return null;
}

const JENIS_PROYEK = [
    'website' => ['label' => 'Website',   'tombol' => 'Kunjungi Website', 'alat' => 'Teknologi'],
    'uiux'    => ['label' => 'UI/UX',     'tombol' => 'Lihat Desain',     'alat' => 'Alat desain'],
    'game'    => ['label' => 'Game',      'tombol' => 'Mainkan Game',     'alat' => 'Engine & alat'],
];

function label_jenis(string $jenis): string
{
    return JENIS_PROYEK[$jenis]['label'] ?? ucfirst($jenis);
}

function gambar_proyek(?string $berkas): ?string
{
    if (!$berkas) {
        return null;
    }
    $aman = basename($berkas);
    return is_file(ROOT_PATH . '/assets/images/projects/' . $aman) ? aset('images/projects/' . $aman) : null;
}

/* ---------------- Dokumen (CV & transkrip) ---------------- */
function dokumen(string $kunci): ?array
{
    $d = (konten('dokumen') ?? [])[$kunci] ?? null;
    if (!$d) {
        return null;
    }
    $path = ROOT_PATH . '/assets/documents/' . basename($d['berkas']);
    $d['ada'] = is_file($path) && filesize($path) > 0;
    $d['url'] = $d['ada'] ? aset('documents/' . rawurlencode(basename($d['berkas']))) : null;
    $d['ukuran'] = $d['ada'] ? number_format(filesize($path) / 1048576, 1, ',', '.') . ' MB' : null;
    return $d;
}

/* ---------------- Foto profil ---------------- */
function foto_profil(): ?string
{
    $f = konten('foto');
    if (!$f) {
        return null;
    }
    return is_file(ROOT_PATH . '/' . ltrim($f, '/')) ? url($f) : null;
}

/* ---------------- Avatar (bulat, navbar & footer) ---------------- */
function avatar_html(): string
{
    $a = konten('avatar');
    if ($a && is_file(ROOT_PATH . '/' . ltrim($a, '/'))) {
        return '<span class="brand__mark brand__mark--foto"><img src="' . h(url($a)) . '" alt="" width="44" height="44"></span>';
    }
    return '<span class="brand__mark">' . h(konten('inisial')) . '</span>';
}

/* ---------------- CSRF & flash ---------------- */
function csrf_token(): string
{
    mulai_sesi();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_input(): string
{
    return '<input type="hidden" name="_token" value="' . h(csrf_token()) . '">';
}

function csrf_valid(): bool
{
    mulai_sesi();
    $kirim = $_POST['_token'] ?? '';
    return is_string($kirim) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $kirim);
}

function flash(string $kunci, $nilai = null)
{
    mulai_sesi();
    if ($nilai !== null) {
        $_SESSION['_flash'][$kunci] = $nilai;
        return null;
    }
    $v = $_SESSION['_flash'][$kunci] ?? null;
    unset($_SESSION['_flash'][$kunci]);
    return $v;
}

/* ---------------- Database ---------------- */
function db(): ?PDO
{
    static $pdo = false;
    if ($pdo !== false) {
        return $pdo;
    }
    $c = require ROOT_PATH . '/config/database.php';
    try {
        $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s', $c['host'], $c['port'], $c['nama_db'], $c['charset']);
        $pdo = new PDO($dsn, $c['pengguna'], $c['sandi'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (Throwable $e) {
        error_log('Koneksi database gagal: ' . $e->getMessage());
        $pdo = null;
    }
    return $pdo;
}

/* ---------------- Admin ---------------- */
function admin_login(): bool
{
    mulai_sesi();
    return !empty($_SESSION['admin_id']);
}

function wajib_admin(): void
{
    if (!admin_login()) {
        arahkan('admin/login.php');
    }
}

/* ---------------- Ikon (SVG inline, gaya garis) ---------------- */
function ikon(string $nama, int $ukuran = 18, string $kelas = ''): string
{
    static $p = [
        'arrow-up-right' => '<path d="M7 7h10v10"/><path d="M7 17 17 7"/>',
        'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'arrow-left'  => '<path d="M19 12H5"/><path d="m12 19-7-7 7-7"/>',
        'arrow-down'  => '<path d="M12 5v14"/><path d="m19 12-7 7-7-7"/>',
        'eye'      => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/>',
        'download' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/>',
        'github'   => '<path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/>',
        'mail'     => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
        'moon'     => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
        'sun'      => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>',
        'menu'     => '<path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/>',
        'x'        => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        'check'    => '<path d="M20 6 9 17l-5-5"/>',
        'file'     => '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><path d="M14 2v6h6"/>',
        'grad'     => '<path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
        'send'     => '<path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>',
        'lock'     => '<rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
        'image'    => '<rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"/>',
        'search'   => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
        'trash'    => '<path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>',
        'inbox'    => '<path d="M22 12h-6l-2 3h-4l-2-3H2"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>',
        'logout'   => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/>',
        'code'     => '<path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/>',
        'layout'   => '<rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/>',
        'gamepad'  => '<path d="M6 12h4"/><path d="M8 10v4"/><path d="M15 13h.01"/><path d="M18 11h.01"/><path d="M17.3 5H6.7a4 4 0 0 0-3.9 3.1l-1.6 7A3 3 0 0 0 4.1 19c1 0 1.9-.5 2.4-1.3L7.5 16h9l1 1.7c.5.8 1.400 1.300 2.400 1.300a3 3 0 0 0 2.900-3.900l-1.600-7A4 4 0 0 0 17.300 5Z"/>',
        'user'     => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/>',
        'key'      => '<circle cx="7.5" cy="15.5" r="4.5"/><path d="m10.7 12.3 9.8-9.8"/><path d="m16 7 3 3"/>',
        'map'      => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
        'copy'     => '<rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2"/>',
    ];
    $isi = $p[$nama] ?? '';
    return '<svg class="icon ' . h($kelas) . '" xmlns="http://www.w3.org/2000/svg" width="' . $ukuran . '" height="' . $ukuran
        . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
        . $isi . '</svg>';
}

/* ---------------- Potong teks ---------------- */
function potong(string $teks, int $maks = 160): string
{
    $teks = trim(preg_replace('/\s+/', ' ', $teks));
    return mb_strlen($teks) > $maks ? rtrim(mb_substr($teks, 0, $maks - 1)) . '…' : $teks;
}
