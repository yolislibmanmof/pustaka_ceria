<?php
/**
 * Template by          : Tutorial SLiMS
 * Template description : Integrated library catalog search theme for SLiMS 9.8.0 (ID/EN)
 * Email                : tutorialslims@gmail.com
 * Instagram            : https://instagram.com/tutorial_slims (@tutorial_slims)
 * Copyright            : (c) Tutorial SLiMS. Licensed under GPLv3.
 * Template ini merupakan ide dari Hendro Wicaksono | Email : hendro.wicaksono@gmail.com
 */

/**
 * Terjemahan tambahan untuk template Pustaka Ceria (v3 — Master).
 *
 * Teks sumber (msgid) ditulis dalam bahasa Inggris, sehingga mode EN tampil apa adanya
 * dan mode ID memakai terjemahan di bawah ini. Terjemahan bawaan SLiMS (messages.mo)
 * tetap diprioritaskan; daftar ini hanya melengkapi teks yang belum ada di sana.
 *
 * Catatan: string 'Whatever your SLiMS error problem is...' tetap dipertahankan
 * karena dipanggil oleh _credit.php untuk mekanisme guard atribusi (meskipun
 * tampilannya sudah dipindah ke kolom Contact & Support di footer v2).
 */
\SLiMS\Polyglot\Memory::getInstance()->appendWords([
  'id_ID' => [

    /* ============================================================
       BERANDA / HERO
       ============================================================ */
    'Public School Library Catalog' => 'Katalog Perpustakaan Sekolah',
    "Let's explore the world" => 'Ayo jelajahi dunia',
    'through reading!' => 'lewat membaca!',
    'One-stop search for school library collections' => 'Satu pintu pencarian koleksi perpustakaan sekolah',
    'Reading is a window to the world. Every book opens a new adventure.' => 'Membaca adalah jendela dunia. Setiap buku membuka satu petualangan baru.',
    'Explore Collection Categories' => 'Jelajahi Kategori Koleksi',
    'Choose the type of collection, source, or school library you want to explore.' => 'Pilih jenis koleksi, sumber, atau perpustakaan sekolah yang ingin kamu jelajahi.',
    'Popular Subjects' => 'Subjek Populer',
    'Favorite topics with the most items available. Start your reading adventure here!' => 'Topik favorit yang paling banyak tersedia. Mulai petualangan membacamu dari sini!',
    'Type of Material' => 'Jenis',
    'Repository Name' => 'Nama Repositori',
    'Library' => 'Perpustakaan',
    '1 category' => '1 kategori',
    '%d categories' => '%d kategori',
    'No data yet' => 'Belum ada data',

    /* ============================================================
       NAVIGASI & UI
       ============================================================ */
    'Home' => 'Beranda',
    'Index' => 'Indeks',
    'Information' => 'Informasi',
    'News' => 'Berita',
    'Help' => 'Bantuan',
    'Librarian' => 'Pustakawan',
    'Basket' => 'Keranjang',
    'Menu' => 'Menu',
    'All Menus' => 'Semua Menu',
    'Toggle theme' => 'Ganti tema',
    'Template by' => 'Template oleh',
    'Powered by' => 'Didukung oleh',

    /* ============================================================
       PENCARIAN & HASIL
       ============================================================ */
    '%s documents from all sources' => '%s dokumen dari seluruh sumber',
    'Found <strong>{biblio_list->num_rows}</strong> from your keywords' => 'Ditemukan <strong>{biblio_list->num_rows}</strong> dari kata kunci Anda',
    'Sort by' => 'Urutkan',
    'Sort by Newest' => 'Urutkan dari yang Terbaru',
    'Grid view' => 'Tampilan kisi',
    'List view' => 'Tampilan daftar',
    'No Result' => 'Tidak ada hasil',
    'Please try again' => 'Silakan coba lagi',
    'Filter by' => 'Saring berdasarkan',
    'Item Not Available' => 'Item tidak tersedia',

    /* ============================================================
       HALAMAN DETAIL BUKU
       ============================================================ */
    'Back to search results' => 'Kembali ke hasil pencarian',
    'Collections' => 'Koleksi',
    'Abstract / Description' => 'Abstrak / Deskripsi',
    'Overview' => 'Ringkasan',
    'Metadata' => 'Metadata',
    'Similar Documents' => 'Dokumen Serupa',
    'Availability' => 'Ketersediaan',
    'Available' => 'Tersedia',
    'All copies on loan' => 'Semua eksemplar sedang dipinjam',
    '%d of %d copies available' => '%d dari %d eksemplar tersedia',
    'No copy data' => 'Tidak ada data eksemplar',
    'Barcode / Item Code' => 'Barcode / Kode Item',
    'Call No.' => 'No. Panggil',
    'Location & Collection' => 'Lokasi & Koleksi',
    'Status' => 'Status',
    'On Loan' => 'Dipinjam',
    '1 Copy' => '1 Eks',
    '%d Copies' => '%d Eks',
    '1 Item' => '1 Eksemplar',
    '%d Items' => '%d Eksemplar',
    'Download MARC' => 'Unduh MARC',
    'View JSON Record' => 'Lihat Data JSON',
    'Cite This Collection' => 'Kutip Koleksi Ini',
    'Cite' => 'Kutip',
    'Share' => 'Bagikan',
    'Bookmark' => 'Tandai',
    'Bookmarked' => 'Sudah ditandai',
    'No additional notes / abstract for this collection.' => 'Tidak ada catatan / abstrak tambahan untuk koleksi ini.',
    'File Attachment' => 'Lampiran Berkas',
    'No Data' => 'Tidak ada data',
    'Comments' => 'Komentar',
    'You must be logged in to post a comment' => 'Anda harus masuk untuk mengirim komentar',
    'Other version/related' => 'Versi lain / terkait',
    'Subject(s)' => 'Subjek',
    'Content Type' => 'Tipe Konten',
    'Media Type' => 'Tipe Media',
    'Carrier Type' => 'Tipe Carrier',
    'Statement of Responsibility' => 'Pernyataan Tanggung Jawab',

    // field metadata
    'Series Title' => 'Judul Seri',
    'Call Number' => 'No. Panggil',
    'Publisher' => 'Penerbit',
    'Place & Year' => 'Tempat & Tahun',
    'Place & Year Published' => 'Tempat & Tahun Terbit',
    'Edition' => 'Edisi',
    'Physical Description (Collation)' => 'Deskripsi Fisik (Kolasi)',
    'ISBN / ISSN' => 'ISBN / ISSN',
    'Classification' => 'Klasifikasi',
    'Language' => 'Bahasa',
    'Shelf Location' => 'Lokasi Rak',
    'Specific Detail Info' => 'Info Detail Spesifik',
    'Last Updated' => 'Terakhir Diperbarui',

    /* ============================================================
       KLASIFIKASI DDC & PILLS
       ============================================================ */
    'Browse DDC Classification' => 'Jelajahi Klasifikasi DDC',
    'Pick Your Favorite Topics & Subjects' => 'Pilih Topik & Mata Pelajaran Favoritmu',
    'Click a category below to browse the shelves directly.' => 'Klik salah satu kategori di bawah ini untuk menelusuri rak buku secara langsung.',
    'View All Classes (000-900)' => 'Lihat Semua Kelas (000–900)',
    'Browse Collection' => 'Telusuri Koleksi',
    'View All Collections' => 'Lihat Semua Koleksi',
    '%s collections' => '%s koleksi',

    'Computers & General Works' => 'Komputer & Karya Umum',
    'Coding, Informatics, Encyclopedias' => 'Coding, Informatika, Ensiklopedia',
    'Philosophy & Psychology' => 'Filsafat & Psikologi',
    'Psychology & Character' => 'Psikologi & Karakter',
    'Self-development, Ethics, Motivation' => 'Pengembangan Diri, Etika, Motivasi',
    'Religion' => 'Agama',
    'Religion & Character' => 'Agama & Budi Pekerti',
    'Religious Education & Noble Character' => 'Pendidikan Agama & Akhlak Mulia',
    'Social Sciences' => 'Ilmu Sosial',
    'Social Sciences & Education' => 'Ilmu Sosial & Pendidikan',
    'Social Studies, Economics, Law, Scouting' => 'IPS, Ekonomi, Hukum, Pramuka',
    'Language' => 'Bahasa',
    'Language & Dictionaries' => 'Bahasa & Kamus',
    'Indonesian, English, Regional Languages' => 'Bahasa Indonesia, Inggris, Daerah',
    'Pure Science' => 'Sains Murni',
    'Science & Mathematics' => 'Sains & Matematika',
    'Mathematics, Physics, Biology, Chemistry' => 'Matematika, Fisika, Biologi, Kimia',
    'Applied Sciences' => 'Ilmu Terapan',
    'Technology & Applied Sciences' => 'Teknologi & Terapan',
    'Entrepreneurship, Health, Engineering' => 'Kewirausahaan, Kesehatan, Teknik',
    'Art & Recreation' => 'Seni & Rekreasi',
    'Arts, Music & Sports' => 'Seni, Musik & Olahraga',
    'Arts & Culture, Crafts, Physical Education' => 'Seni Budaya, Prakarya, Penjaskes',
    'Literature' => 'Sastra',
    'Literature, Novels & Short Stories' => 'Sastra, Novel & Cerpen',
    'Teen Novels, Poetry, Educational Comics' => 'Novel Remaja, Puisi, Komik Edukasi',
    'History & Geography' => 'Sejarah & Geografi',
    'History, Maps & Biographies' => 'Sejarah, Peta & Biografi',
    'Archipelago History, National Heroes' => 'Sejarah Nusantara, Tokoh Pahlawan',

    /* ============================================================
       KOLEKSI POPULER / TERBARU
       ============================================================ */
    'Librarian Recommendations' => 'Rekomendasi Pustakawan',
    'Popular Collections & Student Textbooks' => 'Koleksi Populer & Buku Pegangan Siswa',
    'Books most often borrowed and used as main study references in our library.' => 'Koleksi buku yang paling sering dipinjam dan menjadi referensi belajar utama di perpustakaan kita.',
    'Just Arrived' => 'Baru Masuk Rak',
    'Newest & Recently Updated Collections' => 'Koleksi Terbaru & Baru Diperbarui',
    'Books and academic works that were just processed and are ready to read today.' => 'Daftar buku dan karya ilmiah yang baru selesai diolah dan siap kamu baca hari ini.',
    'Read More' => 'Baca Selengkapnya',
    'Unavailable' => 'Tidak tersedia',

    /* ============================================================
       MODAL TOPIC (DDC)
       ============================================================ */
    'Select the topic you are interested in' => 'Pilih topik yang kamu minati',
    'Browse by DDC classification — click a class to search directly.' => 'Jelajahi berdasarkan klasifikasi DDC — klik kelas untuk mencari langsung.',
    'Computer Science, Information & General Works' => 'Komputer, Informasi & Karya Umum',
    'Icons made by' => 'Ikon dibuat oleh',
    'from' => 'dari',
    'Close' => 'Tutup',

    /* ============================================================
       MODAL ADVANCED SEARCH
       ============================================================ */
    'Detailed Search' => 'Pencarian Spesifik (Advanced Search)',
    'Advanced Search' => 'Pencarian Spesifik',
    'Combine several search fields at once in table' => 'Gabungkan beberapa kolom pencarian sekaligus pada tabel',
    'All (ALL)' => 'Semua (ALL)',
    'Book Title' => 'Judul Buku',
    'Author Name' => 'Nama Penulis / Pengarang',
    'Topic / Subject' => 'Topik / Mata Pelajaran',
    'Shelf Call Number' => 'Nomor Panggil Rak',
    'Publication Year' => 'Tahun Terbit',
    'Media Format (GMD)' => 'Format Media (GMD)',
    'Collection Type' => 'Jenis Koleksi',
    'Enter words in the title...' => 'Masukkan kata dalam judul...',
    'e.g. Mulyadi, Sugiyono...' => 'Contoh: Mulyadi, Sugiyono...',
    'e.g. Accounting, Psychology, Fiction...' => 'Contoh: Akuntansi, Psikologi, Fiksi...',
    'e.g. 978-979-...' => 'Contoh: 978-979-...',
    'e.g. Erlangga, Salemba...' => 'Contoh: Erlangga, Salemba...',
    'e.g. 2022' => 'Contoh: 2022',
    'Search by column:' => 'Cari berdasarkan kolom:',
    'Matching collections in' => 'Koleksi yang cocok di',
    'Your recent searches:' => 'Pencarian terakhir kamu:',
    'Clear History' => 'Hapus Riwayat',
    'Cancel' => 'Batal',
    'Find Collection' => 'Cari Koleksi',
    'Enter keyword to search collection...' => 'Masukkan kata kunci untuk mencari koleksi...',
    'Search by :' => 'Cari berdasarkan :',

    /* ============================================================
       MODAL SOCIAL MEDIA (Share)
       ============================================================ */
    'Share this collection' => 'Bagikan koleksi ini',
    'Copy link' => 'Salin tautan',
    'Link copied!' => 'Tautan tersalin!',

    /* ============================================================
       MEMBER AREA
       ============================================================ */
    'Member Area' => 'Area Anggota',
    'Member Login' => 'Masuk Anggota',
    'Member Dashboard' => 'Dashboard Anggota',
    'Welcome back' => 'Selamat datang kembali',
    'Sign in to access your personalized library experience.' => 'Masuk untuk mengakses pengalaman perpustakaan pribadi Anda.',
    'Manage your loans, bookmarks, and reading history.' => 'Kelola pinjaman, bookmark, dan riwayat bacaan Anda.',
    'Access your loans, bookmarks, and reading history in one place.' => 'Akses pinjaman, bookmark, dan riwayat bacaan di satu tempat.',
    'Bookmarks' => 'Bookmark',
    'Member Type' => 'Jenis Anggota',
    'Need help?' => 'Butuh bantuan?',
    'If you are a registered member, use your member ID and password to log in.' => 'Jika Anda anggota terdaftar, gunakan ID anggota dan kata sandi Anda untuk masuk.',
    'Not a member yet? Contact the librarian to register.' => 'Belum menjadi anggota? Hubungi pustakawan untuk mendaftar.',
    'Your data is safe' => 'Data Anda aman',
    'We protect your information with industry-standard security. Your password is never shared.' => 'Kami melindungi informasi Anda dengan keamanan standar industri. Kata sandi Anda tidak pernah dibagikan.',

    /* ============================================================
       VISITOR COUNTER
       ============================================================ */
    'Visitor Counter' => 'Counter Pengunjung',
    'Welcome to' => 'Selamat datang di',
    'Please fill your member ID or name.' => 'Silakan isi ID atau nama anggota Anda.',
    'Member ID' => 'ID Anggota',
    'Institution' => 'Institusi',
    'Enter your member ID' => 'Masukkan ID anggota',
    'Enter your institution' => 'Masukkan institusi Anda',
    'Enough fill your member ID if you are member of' => 'Cukup isi ID anggota jika Anda adalah anggota dari',
    'Check In' => 'Check In',

    /* ============================================================
       HALAMAN INFO / HELP / LIBRARIAN
       ============================================================ */
    'Frequently Asked Questions & Guides' => 'Pertanyaan Umum & Panduan',

    /* ============================================================
       KREDIT / GUARD ATRIBUSI (tetap dipanggil oleh _credit.php)
       ============================================================ */
    'Whatever your SLiMS error problem is, we are ready to help, please DM us on Instagram.' => 'Apapun masalah error SLiMS, kami siap membantu, silakan DM ke Instagram.',
  ],

  'en_US' => [
    // English mode: semua string tampil apa adanya (msgid = output)
    // Kosongkan atau isi bila ingin override terjemahan bawaan SLiMS
  ],
]);