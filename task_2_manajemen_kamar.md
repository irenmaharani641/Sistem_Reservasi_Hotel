# Task 2: Manajemen Kamar (Room Management)

## Tujuan
Mengembangkan fitur pengelolaan dan tampilan ketersediaan kamar hotel berdasarkan spesifikasi skema data dalam PRD.

## Spesifikasi Berdasarkan PRD
- Tabel **ROOMS** memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `room_number` (String/Varchar)
  - `type` (enum: 'Standard', 'Deluxe', 'Suite')
  - `price_per_night` (Decimal)
  - `description` (Text)
  - `is_available` (Boolean)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat berkas migrasi baru (jika belum ada) untuk tabel `rooms` lengkap dengan definisi tipe data sesuai PRD.
   - Ikuti tata cara *naming convention* Eloquent standar yang sudah digunakan di dalam proyek (contoh: penggunaan *timestamps* default).

2. **Pembuatan Seeder Data Dummy:**
   - Buat `RoomSeeder` menggunakan *factory* atau seeding manual untuk meng-*generate* minimal 20 kamar dummy.
   - Pastikan terdapat sebaran yang proporsional antara kamar ber-tipe 'Standard', 'Deluxe', dan 'Suite'.
   - Kombinasikan variasi nilai `is_available` (`true`/`false`) agar tampilan di sisi tamu lebih realistis saat visualisasi data.

3. **Logika CRUD:**
   - Implementasikan `RoomController` untuk menangani CRUD kamar.
   - Sesuaikan tingkat otorisasi berbekal fungsi dari Task 1; pastikan hanya `ADMIN` yang berhak melakukan operasi *Create, Update, Delete* kamar.
   - Sediakan logika *Read* (lihat daftar dan detail kamar) yang bisa diakses publik atau `GUEST`.
   - Gunakan format respon dan *styling code* yang sama persis dengan yang ada pada Controller *existing* lainnya. Dilarang merombak pola arsitektur kode.

4. **Validasi Kriteria Penerimaan:**
   - Admin dapat menambah, mengubah harga, tipe, dan status ketersediaan.
   - Tamu dapat melihat daftar kamar lengkap dengan *dummy data* dari seeder.
