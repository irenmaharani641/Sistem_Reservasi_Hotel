# Task 1: Autentikasi dan Manajemen Pengguna

## Tujuan
Menyelaraskan sistem autentikasi dan manajemen pengguna (user management) yang sudah ada di Laravel agar sesuai dengan spesifikasi di PRD, khususnya terkait dengan peran pengguna (user role) untuk RBAC.

## Spesifikasi Berdasarkan PRD
- Tabel **USERS** memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `name`
  - `email`
  - `password_hash` (pada Laravel default `password`)
  - `phone_number`
  - `role` (enum: 'GUEST', 'ADMIN')
  - `created_at` / `updated_at` (timestamps)

## Instruksi Teknis Pelaksanaan
1. **Pengecekan & Penyesuaian Struktur Database (Migration):**
   - Lakukan pengecekan pada tabel/migrasi `users` yang *existing*.
   - Buat *migration* tambahan (atau modifikasi yang ada jika belum diluncurkan) untuk menambahkan kolom `phone_number` dan `role` (jadikan default role sebagai `GUEST`).
   - Wajib mengikuti konvensi penamaan tabel/kolom bawaan Laravel dan pola aplikasi yang sedang berjalan.

2. **Pembuatan Seeder Data Dummy:**
   - Perbarui atau buat `UserSeeder`.
   - Buat logika seeding untuk mendisribusikan *role*: sertakan minimal 2 data dummy sebagai `ADMIN` dan minimal 10 data sebagai `GUEST`.
   - Tujuannya adalah memastikan visualisasi fitur yang berbasis *role* bisa diuji secara langsung.

3. **Penyesuaian Logika CRUD dan Autentikasi:**
   - Identifikasi struktur kode *existing* (misalnya: pola Controller, Form Requests, dan Model untuk User).
   - Modifikasi logika *Create, Read, Update, Delete* pada manajemen pengguna agar membaca dan menyimpan kolom `role` dan `phone_number`.
   - Terapkan *middleware* (baik membuat baru atau memodifikasi yang ada) untuk menangani *Role-Based Access Control*, pastikan hanya role `ADMIN` yang memiliki hak untuk manajemen level staf.
   - **Penting:** Dilarang menggunakan atau membuat *design pattern* baru (contoh: bila saat ini menggunakan fat controller, ikuti saja, atau bila menggunakan repository pattern, ikuti polanya). Jaga konsistensi absolut dengan kode saat ini.

4. **Validasi Kriteria Penerimaan (Acceptance Criteria):**
   - User dengan role `GUEST` bisa login dan diarahkan ke halaman yang sesuai.
   - User dengan role `ADMIN` bisa login, memanipulasi CRUD pada pengguna, dan diarahkan ke dasbor admin.
   - Data Seeder berhasil masuk tanpa kendala.
