# Task 10: Program Loyalitas Pelanggan (Loyalty Points)

## Tujuan
Sistem reward poin agar tamu bisa menukarkan *(redeem)* diskon khusus di masa mendatang.

## Spesifikasi Berdasarkan PRD
- Tabel **LOYALTY_POINTS** memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `user_id` (Foreign Key ke tabel users)
  - `points` (Integer)
  - `transaction_type` (enum: 'EARNED', 'REDEEMED')
  - `created_at` (Datetime)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat tabel riwayat `loyalty_points`.
   
2. **Pembuatan Seeder Data Dummy:**
   - Buat `LoyaltyPointSeeder` yang menambahkan poin positif (EARNED) secara fiktif untuk pengguna tertentu.

3. **Logika Fitur Perhitungan Poin:**
   - Otomatiskan *trigger*: setiap kali sebuah *booking* lunas/selesai, sistem menyuntikkan poin (EARNED). Jika poin ditukar, rekam sebagai REDEEMED.
   - Jangan ngoding dulu, ikuti instruksi.
