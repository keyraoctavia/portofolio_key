<?php
/**
 * ISI DATA DIRI & KONTEN WEBSITE.
 * Ubah teks di file ini saja — halaman akan ikut berubah.
 * Isi proyek ada di config/proyek.php.
 */
return [

    // ---------- Profil ----------
    'nama'        => 'Keyra Oktaviani',
    'inisial'     => 'KO',
    'peran'       => 'Siswi Rekayasa Perangkat Lunak',
    'sekolah'     => 'SMKN 1 Katapang',
    // Foto kecil bulat di pojok kiri atas navbar & footer (ganti file assets/images/avatar.jpg, kotak 1:1). null = tampil inisial.
    'avatar'      => 'assets/images/avatar.jpg',
    'foto'        => 'assets/images/foto-profil.jpg',   // ganti file ini untuk mengganti foto (rasio 4:5). null = tampil inisial.
    'status'      => 'Sedang memperdalam Laravel dan React',
    'lencana'     => 'Terbuka untuk belajar & kolaborasi',

    'judul_utama' => 'Mengubah ide jadi',
    'judul_aksen' => 'website dan aplikasi.',

    'deskripsi_singkat' =>
        'Siswi RPL di SMKN 1 Katapang yang suka membangun website dan aplikasi, '
        . 'mulai dari tampilan sampai logika di belakangnya. Saya juga mulai menjajal desain UI/UX dan pembuatan game.',

    // ---------- Tentang ----------
    'tentang_judul' => 'Belajar lewat proyek nyata.',
    'tentang' => [
        'Saya Keyra, siswi jurusan Rekayasa Perangkat Lunak di SMKN 1 Katapang (2024–2027). Saya tertarik pada pengembangan perangkat lunak dan teknologi, terutama membuat website yang rapi, mudah dipakai, dan benar-benar berguna.',
        'Selama sekolah saya mengerjakan beberapa proyek: sistem kasir untuk kantin, website cafe, company profile, sampai aplikasi inventaris multi-gudang, sebagian besar dengan Laravel dan MySQL. Dari situ saya belajar bahwa kode yang bagus harus dibarengi tampilan yang nyaman dan alur yang jelas.',
        'Saya teliti, cepat menyesuaikan diri, dan nyaman bekerja sendiri maupun dalam tim. Di luar kelas, saya aktif di Pramuka dan dipercaya sebagai kandidat Pradana.',
    ],
    'sorotan' => [
        ['judul' => 'Pengembangan Web', 'isi' => 'HTML, CSS, JavaScript, PHP, dan MySQL untuk website dan sistem informasi.', 'ikon' => 'code'],
        ['judul' => 'Desain UI/UX',      'isi' => 'Merancang tampilan aplikasi mobile: alur pengguna, layar kasir, sampai identitas visual.', 'ikon' => 'layout'],
        ['judul' => 'Pembuatan Game',    'isi' => 'Membuat dua game dengan Godot: Sleuth: The First Case (3D) dan Steps Your Game (pixel 2D).', 'ikon' => 'gamepad'],
    ],
    'kutipan' => null,

    // ---------- Keahlian ----------
    'keahlian' => [
        ['kelompok' => 'Pengembangan Web', 'daftar' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL', 'Laravel 13'], 'utama' => ['PHP', 'MySQL', 'Laravel 13']],
        ['kelompok' => 'Alat & Kolaborasi', 'daftar' => ['Git', 'GitHub', 'Manajemen waktu', 'Kerja tim']],
        ['kelompok' => 'Sedang Dipelajari', 'daftar' => ['Laravel (lebih dalam)', 'React']],
        ['kelompok' => 'Desain & Game', 'daftar' => ['Desain UI/UX mobile', 'Desain logo & identitas visual', 'Godot (game 2D & 3D)', 'Game first-person']],
    ],
    // Nilai dari CV (skala 1–10).
    'keterampilan' => [
        ['nama' => 'Komunikasi',   'nilai' => 9],
        ['nama' => 'Kepemimpinan', 'nilai' => 9],
        ['nama' => 'Pekerja Keras', 'nilai' => 10],
        ['nama' => 'Cekatan',      'nilai' => 8],
    ],
    'bahasa' => [
        ['nama' => 'Bahasa Indonesia', 'nilai' => 10],
        ['nama' => 'Bahasa Inggris',   'nilai' => 8],
    ],

    // ---------- Pendidikan (urut dari terbaru) ----------
    'pendidikan' => [
        ['sekolah' => 'SMKN 1 Katapang', 'jurusan' => 'Rekayasa Perangkat Lunak', 'tahun' => '2024 – 2027', 'catatan' => 'Sedang menempuh pendidikan.'],
        ['sekolah' => 'SMPN 1 Soreang',  'jurusan' => null, 'tahun' => '2021 – 2024', 'catatan' => null],
        ['sekolah' => 'SDN Cingcin 2',   'jurusan' => null, 'tahun' => '2015 – 2021', 'catatan' => null],
    ],

    // ---------- Organisasi ----------
    'organisasi' => [
        [
            'nama' => 'Organisasi Kepramukaan', 'tahun' => '2019 – 2026',
            'poin' => [
                'Dipercaya sebagai kandidat Pradana, bentuk pengakuan atas kemampuan kepemimpinan dan tanggung jawab dari anggota lain.',
                'Aktif berkoordinasi dan bekerja sama dalam tim untuk menjalankan program dan kegiatan kepramukaan.',
            ],
        ],
    ],

    // ---------- Dokumen ----------
    // Taruh berkasnya di assets/documents/ dengan nama persis seperti di bawah.
    'dokumen' => [
        'cv' => [
            'judul'     => 'Curriculum Vitae',
            'keterangan'=> 'Ringkasan profil, proyek, kemampuan, pendidikan, dan pengalaman organisasi.',
            'berkas'    => 'cv.pdf',
        ],
        'transkrip' => [
            'judul'     => 'Transkrip Nilai',
            'keterangan'=> 'Rekap nilai akademik di SMKN 1 Katapang.',
            'berkas'    => 'transkrip-nilai.pdf',
        ],
    ],

    // ---------- Kontak & tautan ----------
    'email'  => 'keyraoktaviani84@gmail.com',
    'github' => 'https://github.com/keyraoctavia',
    'github_user' => '@keyraoctavia',
    'lokasi' => 'Kab. Bandung, Jawa Barat',
    // Nomor telepon & alamat lengkap sengaja tidak ditampilkan di web publik. Ada di file CV.

    'tagline_footer' => 'Dibuat dengan PHP Native, HTML, CSS, dan JavaScript.',
];
