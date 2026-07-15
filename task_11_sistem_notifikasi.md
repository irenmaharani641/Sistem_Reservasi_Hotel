# Task 11: Sistem Notifikasi (Notifications)

## Tujuan
Membuat sistem peringatan dalam-aplikasi untuk interaksi otomatis kepada pengguna (misal: pengingat check-in).

## Spesifikasi Berdasarkan PRD
- Tabel **NOTIFICATIONS** memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `user_id` (Foreign Key ke tabel users)
  - `title` (String)
  - `message` (Text)
  - `is_read` (Boolean default false)
  - `created_at` (Datetime)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat migrasi tabel `notifications`.
   
2. **Pembuatan Seeder Data Dummy:**
   - Buat `NotificationSeeder` berupa contoh-contoh notifikasi pesan bagi user `GUEST`.

3. **Logika Fitur Notifikasi:**
   - Pastikan terdapat rute agar user bisa menandai pesan sebagai sudah dibaca (`is_read` = true).
   - Jangan ngoding dulu, pastikan fitur selaras dengan standard *Notifications* bawaan Laravel (jika memungkinkan) atau polanya tetap seragam.
