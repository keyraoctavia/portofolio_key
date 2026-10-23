# Portofolio Keyra Oktaviani — PHP Native

Website portofolio (PHP Native + MySQL + HTML/CSS/JS), tanpa Laravel / Composer / Node.

## Struktur folder
```
index.php            beranda (hero, tentang, proyek, keahlian, pendidikan, dokumen, kontak)
proyek.php           katalog semua proyek (cari + filter jenis)
detail-proyek.php    halaman detail satu proyek (?slug=...)
config/
  konten.php         DATA DIRI: nama, foto, tentang, keahlian, pendidikan, kontak, GitHub
  proyek.php         DAFTAR PROYEK (website, UI/UX, game) + akun demo + tautan
  database.php       user/password MySQL
  app.php            pengaturan umum
includes/            fungsi bantu, header, navbar, footer, kartu proyek
proses/kontak.php    memproses formulir kontak
admin/               login, pesan masuk, pasang.php (buat admin pertama)
assets/css, js       tampilan & interaksi
assets/images/       foto-profil.jpg + projects/ (gambar proyek)
assets/documents/    cv.pdf, transkrip-nilai.pdf
database/portfolio.sql
```

## Menjalankan (Laragon / XAMPP)
1. Salin folder ini ke `C:\laragon\www\portofolio` (Laragon) atau `C:\xampp\htdocs\portofolio` (XAMPP).
2. Start Apache + MySQL.
3. Buka `http://localhost/portofolio/` (Laragon: `http://portofolio.test`).
   Halaman publik sudah jalan tanpa database. Database hanya untuk pesan kontak & admin.

## Impor database
- phpMyAdmin → Import → pilih `database/portfolio.sql` (otomatis membuat database `portofolio_keyra`).
- Cek `config/database.php` (bawaan Laragon/XAMPP: user `root`, sandi kosong). Di hosting, isi data dari panel hosting.
- Buka `/admin/pasang.php` → buat akun admin → **hapus file `admin/pasang.php`**. Lalu masuk di `/admin/login.php`.

## Mengganti isi
| Yang diganti | Caranya |
|---|---|
| Nama, deskripsi, tentang, keahlian, pendidikan, email, GitHub | edit `config/konten.php` |
| Foto profil | timpa `assets/images/foto-profil.jpg` (rasio 4:5) |
| Foto bulat kecil di navbar & footer | timpa `assets/images/avatar.jpg` (kotak 1:1); set `'avatar' => null` di `config/konten.php` untuk kembali ke inisial |
| CV | timpa `assets/documents/cv.pdf` |
| Transkrip nilai | timpa `assets/documents/transkrip-nilai.pdf` (kalau berkas dihapus, tombol berubah jadi "segera tersedia") |
| Proyek baru | salin satu blok di `config/proyek.php`, taruh gambar di `assets/images/projects/` |
| Gambar proyek | ganti file di `assets/images/projects/` atau ubah kolom `gambar` |
| Link GitHub proyek | isi `repo_url` di `config/proyek.php` (null = tombol tidak tampil) |
| Deskripsi game Sleuth | `config/proyek.php` → blok `sleuth-the-first-case`, kolom `deskripsi` |
| Teknologi/engine game | kolom `teknologi` (kosong = tidak ditampilkan) |

Kalau tautan/CSS tidak muncul (misal di subfolder hosting), isi `BASE_URL_MANUAL` di `config/app.php`.
