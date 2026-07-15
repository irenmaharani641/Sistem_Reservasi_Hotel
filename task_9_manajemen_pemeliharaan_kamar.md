# Task 9: Manajemen Pemeliharaan Kamar (Maintenances)

## Tujuan
Pencatatan masalah di kamar agar staf/admin bisa menjadwalkan perbaikan.

## Spesifikasi Berdasarkan PRD
- Tabel **MAINTENANCES** memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `room_id` (Foreign Key ke tabel rooms)
  - `reported_by_user_id` (Foreign Key ke tabel users)
  - `issue_description` (String)
  - `status` (enum: 'PENDING', 'IN_PROGRESS', 'RESOLVED')
  - `resolved_at` (Datetime - Nullable)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat migrasi tabel `maintenances`.
   
2. **Pembuatan Seeder Data Dummy:**
   - Buat `MaintenanceSeeder` berupa laporan palsu kerusakan AC, saluran air, dll.

3. **Logika Fitur Pelaporan:**
   - Tamu bisa melaporkan isu, atau staf admin yang mencatat secara proaktif. 
   - Kamar yang sedang `IN_PROGRESS` pada pemeliharaan seharusnya tidak tampil pada pencarian tamu (is_available = false).
   - Jangan ngoding dulu, rencanakan pemicu (event) untuk mematikan ketersediaan kamar.
