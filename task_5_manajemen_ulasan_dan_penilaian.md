# Task 5: Manajemen Ulasan dan Penilaian (Reviews)

## Tujuan
Mengembangkan fitur untuk menampung ulasan tamu mengenai kamar setelah melakukan *check-out*.

## Spesifikasi Berdasarkan PRD
- Tabel **REVIEWS** memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `booking_id` (Foreign Key ke tabel bookings)
  - `user_id` (Foreign Key ke tabel users)
  - `room_id` (Foreign Key ke tabel rooms)
  - `rating` (Integer: 1 to 5)
  - `comment` (Text)
  - `created_at` (Datetime)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat migrasi untuk tabel `reviews` dengan batasan (`foreign key`) ke `bookings`, `users`, dan `rooms`.
   
2. **Pembuatan Seeder Data Dummy:**
   - Buat `ReviewSeeder` yang mengambil sampel dari data tabel `bookings` (dengan status `CONFIRMED` atau terselesaikan) untuk diisikan *rating* dan komentar acak.

3. **Logika Fitur Ulasan:**
   - Implementasikan *controller* agar tamu (`GUEST`) yang memiliki riwayat *booking* dapat membuat ulasan untuk kamar yang disewanya.
   - Jangan ngoding dulu, pastikan semua konvensi penamaan sesuai modul-modul lainnya.
