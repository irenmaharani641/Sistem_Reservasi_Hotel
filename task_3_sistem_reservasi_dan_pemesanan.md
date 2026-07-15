# Task 3: Sistem Reservasi dan Pemesanan

## Tujuan
Mengimplementasikan modul pemesanan (booking) yang memfasilitasi transaksi kamar dari tamu (GUEST), termasuk mekanisme pengecekan ketersediaan secara simultan.

## Spesifikasi Berdasarkan PRD
- Tabel **BOOKINGS** memerlukan struktur kolom:
  - `id` (Primary Key)
  - `user_id` (Foreign Key ke tabel users)
  - `room_id` (Foreign Key ke tabel rooms)
  - `check_in_date` (Date)
  - `check_out_date` (Date)
  - `total_price` (Decimal)
  - `status` (enum: 'PENDING', 'CONFIRMED', 'CANCELLED')
  - `created_at` / `updated_at`

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat migrasi untuk tabel `bookings` dan tetapkan relasi konstrain (*foreign key*) yang tepat dengan tabel `users` dan `rooms`.

2. **Pembuatan Seeder Data Dummy:**
   - Buat `BookingSeeder` yang mengambil sampel acak ID dari tabel `users` (dengan role `GUEST`) dan ID dari tabel `rooms`.
   - Simulasikan riwayat pemesanan masa lalu dan yang sedang berjalan melalui berbagai status ('PENDING', 'CONFIRMED', 'CANCELLED').
   - Hasilkan minimal 15 data pemesanan dummy.

3. **Logika Transaksional & Proses Bisnis:**
   - Buat `BookingController` yang akan memproses masuknya pesanan.
   - Sisipkan logika bisnis: periksa status ketersediaan pada kamar melalui rentang tanggal `check_in_date` dan `check_out_date` agar tidak terjadi *double booking*.
   - Otomatisasikan kalkulasi `total_price` (harga per malam × jumlah malam).
   - Ikuti konvensi penamaan fungsi (*method*) dan struktur validasi (seperti *Form Request*) sesuai standar yang berlaku pada proyek ini.

4. **Validasi Kriteria Penerimaan:**
   - Tamu berhasil membuat pemesanan, dan tabel *booking* terisi dengan *total_price* yang akurat.
   - Admin dapat melihat semua pesanan masuk secara real-time.
