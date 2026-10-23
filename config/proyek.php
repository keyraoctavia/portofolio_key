<?php
/**
 * DAFTAR PROYEK PORTOFOLIO.
 * Tambah proyek baru dengan menyalin satu blok [ ... ] lalu ubah isinya.
 *
 * Kolom:
 *  slug       : nama unik untuk URL (huruf kecil, tanpa spasi)
 *  jenis      : 'website' | 'uiux' | 'game'
 *  gambar     : file di assets/images/projects/ (null = tampil placeholder)
 *  galeri     : gambar tambahan [ ['berkas' => '...', 'keterangan' => '...'] ]
 *  demo_url   : tautan situs/demo (null = tombol tidak muncul)
 *  repo_url   : tautan repository GitHub proyek (null = tombol tidak muncul)
 *  akun_demo  : daftar akun login untuk mencoba aplikasi (opsional)
 *  unggulan   : true = tampil di beranda
 */
return [

    // ======================================================== WEBSITE
    [
        'slug' => 'pt-sinar-nusantara',
        'jenis' => 'website',
        'judul' => 'PT Sinar Nusantara — Inventaris Multi-Gudang',
        'kategori' => 'Sistem Informasi / Inventaris',
        'ringkasan' => 'Aplikasi web inventaris untuk mengelola barang, stok di beberapa gudang, barang masuk, penjualan, dan transfer antar gudang. Login memakai beberapa akun (administrator dan operator).',
        'deskripsi' => [
            'PT Sinar Nusantara adalah aplikasi web pengelolaan inventaris multi-gudang yang dibangun dengan Laravel 13 dan database MySQL. Aplikasi ini membantu perusahaan mencatat barang, memantau persediaan di tiap gudang, dan merekam transaksi harian dalam satu sistem.',
            'Dashboard menampilkan ringkasan langsung dari database: total barang, total gudang beserta jumlah unit persediaan, total pelanggan, penjualan hari ini, grafik penjualan 14 hari terakhir (hanya transaksi yang sudah diposting), dan daftar barang dengan stok terendah.',
            'Untuk masuk ke aplikasi, pengguna harus login. Sistem ini menyediakan beberapa akun dengan peran berbeda — satu administrator dan dua operator. Akun demo untuk mencobanya ada di bagian "Akun Demo" di bawah.',
        ],
        'tujuan' => 'Memudahkan pencatatan stok dan transaksi barang di beberapa gudang agar data persediaan selalu terbaru dan mudah dipantau.',
        'fitur' => [
            'Login dengan beberapa akun (administrator dan operator)',
            'Dashboard ringkasan: total barang, gudang, pelanggan, dan penjualan hari ini',
            'Grafik penjualan 14 hari terakhir',
            'Peringatan barang dengan stok menipis (batas ≤ 10 unit)',
            'Master data: barang, kategori, satuan, gudang, dan pelanggan',
            'Persediaan per gudang, barang masuk, penjualan, dan transfer antar gudang',
            'Riwayat transaksi dan pencarian berdasarkan SKU atau nama barang',
        ],
        'teknologi' => ['Laravel 13', 'PHP', 'MySQL', 'HTML', 'CSS', 'JavaScript'],
        'peran' => null,
        'status' => null,
        'platform' => 'Web',
        'gambar' => 'sinar-nusantara.jpg',
        'alt' => 'Dashboard aplikasi inventaris PT Sinar Nusantara berisi ringkasan barang, gudang, pelanggan, grafik penjualan, dan stok terendah',
        'galeri' => [],
        'demo_url' => 'https://keysekolah.freehosting.dev/index.php/login',
        'demo_label' => 'Buka Halaman Login',
        'repo_url' => null,
        'akun_demo' => [
            ['peran' => 'Administrator', 'nama' => 'Administrator',  'email' => 'admin@sinarnusantara.test',     'sandi' => 'Admin#12345'],
            ['peran' => 'Operator',      'nama' => 'Operator Satu',  'email' => 'operator1@sinarnusantara.test', 'sandi' => 'Operator#12345'],
            ['peran' => 'Operator',      'nama' => 'Operator Dua',   'email' => 'operator2@sinarnusantara.test', 'sandi' => 'Operator#12345'],
        ],
        'unggulan' => true,
    ],
    [
        'slug' => 'smkn-1-katapang',
        'jenis' => 'website',
        'judul' => 'Website SMKN 1 Katapang',
        'kategori' => 'Website Sekolah',
        'ringkasan' => 'Website sekolah berisi informasi jurusan, guru, mata pelajaran, pembiasaan, dan ekskul, plus koperasi seragam digital dengan pembayaran QRIS dan akun siswa.',
        'deskripsi' => [
            'Website SMKN 1 Katapang mengumpulkan informasi akademik dan layanan sekolah dalam satu tempat: jurusan, guru, mata pelajaran, kegiatan pembiasaan, dan ekstrakurikuler.',
            'Selain informasi, ada fitur koperasi digital: siswa mendaftar akun, lalu berlangganan seragam (misalnya seragam batik) dan membayar tagihan bulanan lewat QRIS. Halaman utama menampilkan status langganan dan ringkasan jumlah jurusan, guru, dan siswa terdaftar.',
            'Proyek ini saya kerjakan secara fullstack, mulai dari merancang UI/UX sampai menulis kode dengan Laravel 13 dan database MySQL.',
        ],
        'tujuan' => 'Memudahkan siswa dan orang tua mengakses informasi sekolah serta membayar iuran koperasi seragam secara digital.',
        'fitur' => [
            'Halaman informasi jurusan, guru, mata pelajaran, pembiasaan, dan ekskul',
            'Daftar akun siswa serta menu Masuk dan Daftar',
            'Koperasi seragam: status langganan dan pembayaran tagihan bulanan lewat QRIS',
            'Statistik ringkas jumlah jurusan, guru, dan siswa terdaftar',
            'Tombol chat cepat di pojok halaman',
        ],
        'teknologi' => ['Laravel 13', 'PHP', 'MySQL', 'HTML', 'CSS', 'JavaScript'],
        'peran' => 'Fullstack Developer & UI/UX Designer',
        'status' => null,
        'platform' => 'Web',
        'gambar' => 'smkn1-katapang.jpg',
        'alt' => 'Halaman utama website SMKN 1 Katapang bertema biru tua dengan kartu status langganan koperasi seragam',
        'galeri' => [],
        'demo_url' => null,   // isi tautan website kalau sudah online
        'demo_label' => 'Kunjungi Website',
        'repo_url' => null,
        'unggulan' => true,
    ],
    [
        'slug' => 'bubur-ayam-pak-usup-web',
        'jenis' => 'website',
        'judul' => 'Website Bubur Ayam Pak Usup',
        'kategori' => 'Website Pemesanan Kuliner',
        'ringkasan' => 'Website pemesanan untuk usaha bubur ayam: lihat menu, pesan online tanpa login, pilih pembayaran, dan lacak pesanan. Dibuat dari desain UI/UX milik saya sendiri.',
        'deskripsi' => [
            'Website Bubur Ayam Pak Usup adalah versi web dari desain UI/UX Pak Usup yang saya rancang. Pelanggan bisa melihat menu, memesan lewat tombol Pesan Sekarang, memakai keranjang, dan melacak pesanan lewat halaman Lacak Pesanan.',
            'Pesanan tidak perlu login. Pelanggan juga bisa memesan lewat GoFood atau GrabFood, dan pilihan pembayaran yang ditampilkan adalah tunai, transfer, atau QRIS. Halaman utama menampilkan status buka atau tutup beserta jam bukanya.',
            'Saya mengerjakannya secara fullstack: dari UI/UX sampai kode dengan Laravel 13 dan database MySQL.',
        ],
        'tujuan' => 'Membuat pelanggan mudah memesan bubur ayam dari rumah, ambil sendiri atau datang langsung ke kedai.',
        'fitur' => [
            'Menu bubur ayam dan keranjang pesanan',
            'Pesan tanpa login',
            'Lacak pesanan',
            'Pesan lewat GoFood dan GrabFood',
            'Pembayaran tunai, transfer, atau QRIS',
            'Status buka/tutup dan jam buka kedai',
            'Bagian Tentang, Review, dan Lokasi',
        ],
        'teknologi' => ['Laravel 13', 'PHP', 'MySQL', 'HTML', 'CSS', 'JavaScript'],
        'peran' => 'Fullstack Developer & UI/UX Designer',
        'status' => null,
        'platform' => 'Web',
        'gambar' => 'pakusup-web.jpg',
        'alt' => 'Halaman utama website Bubur Ayam Pak Usup dengan foto bubur ayam spesial dan tombol Pesan Sekarang',
        'galeri' => [],
        'demo_url' => null,   // isi tautan website kalau sudah online
        'demo_label' => 'Kunjungi Website',
        'repo_url' => null,
        'unggulan' => true,
    ],
    [
        'slug' => 'kantin-ambu',
        'jenis' => 'website',
        'judul' => 'Kantin Ambu',
        'kategori' => 'Sistem Penjualan',
        'ringkasan' => 'Website sistem pengelolaan penjualan (sales management system) untuk kantin: kasir, katalog resep, pencatatan pengeluaran, dan laporan keuangan.',
        'deskripsi' => [
            'Kantin Ambu adalah sistem pengelolaan penjualan untuk kantin. Admin bisa melihat ringkasan aktivitas hari itu — pendapatan, jumlah transaksi, pengeluaran, dan laba bersih — langsung dari dashboard.',
            'Di proyek ini saya berperan sebagai Front End Developer: menyusun tampilan dashboard, menu navigasi samping, kartu ringkasan, dan tombol akses cepat agar kasir dan admin bisa bekerja dengan cepat.',
        ],
        'tujuan' => 'Membantu pengelola kantin mencatat penjualan dan pengeluaran harian, sehingga laba bersih bisa dipantau tanpa pembukuan manual.',
        'fitur' => [
            'Dashboard ringkasan: pendapatan, transaksi, pengeluaran, dan laba bersih hari ini',
            'Katalog resep',
            'Kasir untuk mencatat transaksi',
            'Menu keuangan dan pencatatan pengeluaran',
            'Riwayat transaksi',
            'Akses cepat: Buka Kasir, Catat Pengeluaran, Lihat Riwayat',
        ],
        'teknologi' => ['HTML', 'CSS', 'JavaScript'],
        'peran' => 'Front End Developer',
        'status' => null,
        'platform' => 'Web',
        'gambar' => 'kantin-ambu.jpg',
        'alt' => 'Dashboard Kantin Ambu dengan kartu pendapatan, transaksi, pengeluaran, dan laba bersih',
        'galeri' => [],
        'demo_url' => 'https://kantinambu.wuaze.com/?i=1',
        'demo_label' => 'Kunjungi Website',
        'repo_url' => null,
        'unggulan' => true,
    ],
    [
        'slug' => 'sweet-siep',
        'jenis' => 'website',
        'judul' => 'Sweet Siep',
        'kategori' => 'Website Cafe',
        'ringkasan' => 'Website cafe minimalis untuk usaha kopi susu gula aren. Pengunjung melihat menu, memasukkannya ke keranjang, lalu memesan lewat WhatsApp.',
        'deskripsi' => [
            'Sweet Siep adalah website untuk usaha kopi susu gula aren dengan tagline "Manisnya Pas, Mood Jadi Gas". Halaman utamanya memperkenalkan brand, menampilkan daftar menu, dan mengajak pengunjung memesan.',
            'Pesanan tidak dibayar lewat website. Pengunjung menyusun keranjang, lalu mengirimkannya lewat WhatsApp; pembayaran dan ketersediaan dikonfirmasi oleh tim Sweet Siep. Di proyek ini saya berperan sebagai Fullstack Developer.',
        ],
        'tujuan' => 'Memperkenalkan brand kopi susu gula aren dan memudahkan pelanggan memesan menu favorit.',
        'fitur' => [
            'Hero dengan tagline dan tombol menuju menu',
            'Bagian Tentang Kami, Keunggulan, dan Testimoni',
            'Daftar menu dengan pencarian dan filter kategori',
            'Keranjang pesanan',
            'Pengiriman pesanan lewat WhatsApp',
            'Informasi lokasi outlet',
            'Navigasi responsif dengan menu mobile',
        ],
        'teknologi' => ['HTML', 'CSS', 'JavaScript', 'Vercel'],
        'peran' => 'Fullstack Developer',
        'status' => 'Selesai',
        'platform' => 'Web',
        'gambar' => 'sweet-siep.jpg',
        'alt' => 'Halaman utama Sweet Siep dengan ilustrasi segelas kopi susu gula aren dan tagline Manisnya Pas, Mood Jadi Gas',
        'galeri' => [],
        'demo_url' => 'https://sweet-siep.vercel.app/',
        'demo_label' => 'Kunjungi Website',
        'repo_url' => null,
        'unggulan' => true,
    ],
    [
        'slug' => 'vyntera-labs',
        'jenis' => 'website',
        'judul' => 'Vyntera Labs',
        'kategori' => 'Company Profile',
        'ringkasan' => 'Website company profile untuk web agency Vyntera Labs: layanan pembuatan website, keunggulan, paket harga, dan ajakan konsultasi.',
        'deskripsi' => [
            'Vyntera Labs adalah website company profile untuk sebuah web agency. Halaman utamanya memperkenalkan layanan (landing page, company profile, dan wedding website), alasan memilih agensi ini, serta pilihan paket harga.',
            'Saya mengerjakan bagian Front End: tema gelap bergaya teknologi, hero dengan ilustrasi ikon teknologi, navigasi lima halaman (Home, About Us, Portofolio, Contact Us, FAQ), dan tombol ajakan untuk berkonsultasi.',
        ],
        'tujuan' => 'Memperkenalkan layanan pembuatan website dan mengarahkan calon klien untuk berkonsultasi.',
        'fitur' => [
            'Navigasi ke halaman Home, About Us, Portofolio, Contact Us, dan FAQ',
            'Hero dengan tombol Lihat Portofolio dan Hubungi Kami',
            'Ringkasan layanan: Landing Page, Company Profile, Wedding Website',
            'Bagian keunggulan dan paket harga',
            'Konsultasi melalui WhatsApp',
        ],
        'teknologi' => ['HTML', 'CSS', 'JavaScript', 'Vercel'],
        'peran' => 'Front End Developer',
        'status' => 'Selesai',
        'platform' => 'Web',
        'gambar' => 'vyntera-labs.jpg',
        'alt' => 'Halaman utama Vyntera Labs bertema gelap dengan judul Wujudkan Website Impianmu Bersama Vyntera Labs',
        'galeri' => [],
        'demo_url' => 'https://vlabs-company.vercel.app/',
        'demo_label' => 'Kunjungi Website',
        'repo_url' => null,
        'unggulan' => true,
    ],

    // ======================================================== UI/UX
    [
        'slug' => 'pak-usup-bubur-ayam',
        'jenis' => 'uiux',
        'judul' => 'Pak Usup — Aplikasi Kasir & Manajemen Bubur Ayam',
        'kategori' => 'Desain Aplikasi Mobile',
        'ringkasan' => 'Desain UI/UX aplikasi mobile untuk usaha Bubur Ayam Pak Usup: halaman pelanggan, kasir POS, papan pesanan dapur, laporan analitik, dan identitas visual.',
        'deskripsi' => [
            'Pak Usup Bubur Ayam adalah usaha bubur ayam (tertulis berdiri sejak 2007 di logonya). Saya merancang tampilan aplikasi mobile-nya, mulai dari halaman untuk pelanggan sampai alat kerja untuk kasir, dapur, dan pemilik.',
            'Palet warna memakai biru kehijauan (teal), kuning, dan navy gelap agar terasa hangat tapi tetap bersih dan mudah dibaca. Kartu besar, tombol jelas, dan navigasi bawah (Menu, Kasir, Pesanan, Laporan) dipilih supaya bisa dipakai cepat saat jam sibuk.',
        ],
        'tujuan' => 'Merancang alur kerja warung bubur yang cepat: pelanggan mudah memesan, kasir cepat mencatat, dapur tahu antrean, dan pemilik bisa membaca laporan harian.',
        'fitur' => [
            'Beranda pelanggan: menu unggulan, keunggulan, testimoni, lokasi, dan tombol pesan lewat GoFood, GrabFood, atau WhatsApp',
            'Kasir POS: pilih menu, keranjang nota, catatan cepat, dan metode bayar Tunai, QRIS, atau BCA',
            'Papan pesanan (order board) dapur dengan status Menunggu, Diproses, dan Selesai untuk dine-in dan pesanan online',
            'Laporan & Analitik: omzet shift, total terjual vs target, metode bayar, jam sibuk, menu terlaris, dan peringatan stok dapur',
            'Identitas visual: logo, ikon aplikasi, dan variasi logo',
        ],
        'teknologi' => [],
        'peran' => 'UI/UX Designer',
        'status' => null,
        'platform' => 'Mobile',
        'gambar' => 'pakusup-cover.jpg',
        'alt' => 'Tiga layar aplikasi Pak Usup: Laporan & Analitik, Kasir POS, dan Order Board',
        'galeri' => [
            ['berkas' => 'pakusup-beranda.jpg', 'keterangan' => 'Beranda pelanggan'],
            ['berkas' => 'pakusup-kasir.jpg',   'keterangan' => 'Kasir POS'],
            ['berkas' => 'pakusup-pesanan.jpg', 'keterangan' => 'Order Board dapur'],
            ['berkas' => 'pakusup-laporan.jpg', 'keterangan' => 'Laporan & Analitik'],
        ],
        // Logo ditampilkan di bagian "Identitas Visual" pada halaman detail.
        'logo' => [
            ['berkas' => 'pakusup-ikon.png',     'keterangan' => 'Ikon aplikasi'],
            ['berkas' => 'pakusup-logo.png',     'keterangan' => 'Logo horizontal'],
            ['berkas' => 'pakusup-logo-alt.png', 'keterangan' => 'Logo dengan senyum & tahun berdiri'],
        ],
        'demo_url' => null,
        'demo_label' => 'Lihat Desain',
        'repo_url' => null,
        'unggulan' => true,
    ],

    // ======================================================== GAME
    [
        'slug' => 'sleuth-the-first-case',
        'jenis' => 'game',
        'judul' => 'Sleuth: The First Case',
        'kategori' => 'Game Investigasi 3D First-Person',
        'ringkasan' => 'Game investigasi sudut pandang orang pertama. Pemain menjelajahi lokasi kejadian di malam hujan, menyelidiki benda, dan mengumpulkan bukti untuk memecahkan kasus pertama.',

        // >>>>>>>>>> TULIS DESKRIPSI GAME KAMU DI SINI (satu teks = satu paragraf) <<<<<<<<<<
        // Draf di bawah disusun dari isi screenshot. Ganti/tambahkan dengan cerita, tujuan,
        // cara bermain, dan proses pembuatan game versimu sendiri.
        'deskripsi' => [
            'Sleuth: The First Case adalah game investigasi dengan sudut pandang orang pertama. Pemain berperan sebagai penyelidik yang menelusuri lokasi kejadian, mulai dari jalanan saat hujan di malam hari sampai ke dalam rumah.',
            'Setiap level punya tujuan yang tampil di pojok kiri atas, misalnya "Periksa pos radio di seberang jalan". Penanda di layar menunjukkan arah dan jarak ke tujuan, sedangkan skor dan jumlah bukti yang terkumpul (contoh: 0 dari 12) tampil di pojok kanan atas.',
            'Kontrol dasarnya: E untuk menyelidiki benda, TAB untuk membuka ransel, dan F untuk menyalakan senter. Seluruh teks di dalam game memakai Bahasa Indonesia. Game 3D ini dibuat dengan Godot.',
        ],
        'tujuan' => null,
        'fitur' => [
            'Sudut pandang orang pertama dengan suasana malam hujan',
            'Tujuan misi dan penanda arah beserta jarak',
            'Sistem skor dan pengumpulan bukti (12 bukti)',
            'Menyelidiki benda (E), ransel (TAB), dan senter (F)',
            'Teks dan antarmuka dalam Bahasa Indonesia',
            'Dibuat dengan Godot (3D)',
        ],
        'teknologi' => ['Godot'],   // tambahkan bahasa yang dipakai, contoh: 'GDScript'
        'peran' => 'Game Developer',
        'status' => null,
        'platform' => 'PC',
        'gambar' => 'sleuth-1.jpg',
        'alt' => 'Cuplikan game Sleuth: The First Case — pos radio di pinggir jalan saat hujan malam hari',
        'galeri' => [
            ['berkas' => 'sleuth-1.jpg', 'keterangan' => 'Pos radio di seberang jalan saat hujan malam hari'],
            ['berkas' => 'sleuth-2.jpg', 'keterangan' => 'Ruang tamu di dalam rumah'],
        ],
        'demo_url' => null,       // isi tautan game kalau sudah dipublikasikan (itch.io, dll.)
        'demo_label' => 'Mainkan Game',
        'repo_url' => null,
        'unggulan' => true,
    ],
    [
        'slug' => 'steps-your-game',
        'jenis' => 'game',
        'judul' => 'Steps Your Game',
        'kategori' => 'Game Pixel 2D',
        'ringkasan' => 'Game pixel 2D bertema bertani dan mengumpulkan sumber daya: tanam labu, tebang pohon, dan panen apel di sebuah pulau kecil.',

        // >>>>>>>>>> TULIS DESKRIPSI GAME KAMU DI SINI (satu teks = satu paragraf) <<<<<<<<<<
        // Draf ini disusun dari screenshot. Ganti dengan cerita, tujuan, dan cara bermain game-mu.
        'deskripsi' => [
            'Steps Your Game adalah game 2D bergaya pixel art dengan sudut pandang dari atas. Pemain menjelajahi pulau berumput yang dikelilingi laut, lengkap dengan rumah kayu, pohon apel, pagar, dan lahan tanah untuk bercocok tanam.',
            'Hasil kegiatan pemain dihitung sebagai sumber daya di pojok kiri atas, yaitu Pumpkin, Kayu, dan Apel, serta ada level keahlian seperti Farming. Di bagian bawah layar ada tombol menu, termasuk Exit.',
            'Game ini dibuat dengan Godot.',
        ],
        'tujuan' => null,
        'fitur' => [
            'Dunia pixel art 2D dengan pandangan dari atas',
            'Bercocok tanam di lahan tanah',
            'Mengumpulkan Pumpkin, Kayu, dan Apel',
            'Level keahlian (contoh: Farming)',
            'Tombol menu di dalam game',
        ],
        'teknologi' => ['Godot'],
        'peran' => 'Game Developer',
        'status' => null,
        'platform' => 'PC',
        'gambar' => 'steps-your-game.jpg',
        'alt' => 'Cuplikan game Steps Your Game: karakter pixel di pulau dengan lahan tanah, pohon apel, dan hitungan Pumpkin, Kayu, Apel',
        'galeri' => [
            ['berkas' => 'steps-your-game.jpg', 'keterangan' => 'Karakter bertani di lahan tanah dengan hitungan sumber daya di pojok kiri atas'],
        ],
        'demo_url' => null,   // isi tautan game kalau sudah dipublikasikan (itch.io, dll.)
        'demo_label' => 'Mainkan Game',
        'repo_url' => null,
        'unggulan' => true,
    ],
];
