# Task 6: Manajemen Layanan Tambahan (Additional Services)

## Tujuan
Memfasilitasi admin untuk mengelola katalog layanan ekstra yang bisa dipesan (misal: sarapan, spa, antar-jemput).

## Spesifikasi Berdasarkan PRD
- Tabel **ADDITIONAL_SERVICES** memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `name` (String)
  - `description` (Text)
  - `price` (Decimal)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat file migrasi tabel `additional_services`.
   
2. **Pembuatan Seeder Data Dummy:**
   - Buat `AdditionalServiceSeeder` untuk mengisi 5-10 contoh layanan (Spa, Extra Bed, Airport Transfer).

3. **Logika Fitur CRUD:**
   - Buat *controller* untuk Admin guna melakukan CRUD terhadap layanan tambahan.
   - Tamu hanya dapat membaca (Read) daftarnya. 
   - Jangan ngoding dulu, pahami arsitekturnya.
