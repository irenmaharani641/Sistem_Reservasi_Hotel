# Task 8: Manajemen Promosi dan Diskon

## Tujuan
Membuat sistem kupon promosi yang bisa mengurangi total bayar pada saat pemesanan.

## Spesifikasi Berdasarkan PRD
- Tabel **PROMOTIONS** memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `code` (String - Unique)
  - `discount_percentage` (Decimal)
  - `max_discount` (Decimal)
  - `valid_until` (Date)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat migrasi tabel `promotions`. (Perhatikan bahwa tabel `bookings` juga perlu dimodifikasi di Task 3 atau di sini untuk memiliki `promotion_id`).
   
2. **Pembuatan Seeder Data Dummy:**
   - Buat `PromotionSeeder` dengan data promo aktif dan *expired*.

3. **Logika Validasi Promo:**
   - Buat sistem (Controller/Service) agar tamu bisa mengecek validitas kupon saat pemesanan dan menghitung potongan harga akhir.
   - Jangan ngoding dulu, patuhi tata koding di model terkait.
