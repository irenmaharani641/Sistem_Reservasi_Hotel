# Task 4: Integrasi Pembayaran

## Tujuan
Membangun pencatatan transaksi yang mencakup alur konfirmasi pembayaran dan pembaruan status reservasi berdasarkan spesifikasi PRD.

## Spesifikasi Berdasarkan PRD
- Tabel **PAYMENTS** memerlukan struktur kolom:
  - `id` (Primary Key)
  - `booking_id` (Foreign Key ke tabel bookings)
  - `amount` (Decimal)
  - `payment_method` (enum: 'Credit Card', 'Transfer', 'e-Wallet')
  - `status` (enum: 'SUCCESS', 'FAILED', 'PENDING')
  - `payment_date` (Datetime)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat migrasi tabel `payments` dengan konstrain *foreign key* merujuk pada `bookings.id`.

2. **Pembuatan Seeder Data Dummy:**
   - Buat `PaymentSeeder`. Kaitkan *seeder* ini dengan *dummy data* dari tabel bookings yang berstatus 'CONFIRMED' atau 'PENDING'.
   - Masukkan berbagai status pembayaran secara acak untuk memfasilitasi laporan dasbor pada tahap selanjutnya.

3. **Logika Sinkronisasi Pembayaran:**
   - Buat logika/kontroler yang mengurus status bayar. Ketika status payment diubah menjadi `SUCCESS`, maka status pada `bookings` terkait otomatis berubah menjadi `CONFIRMED`.
   - Gunakan pendekatan struktur yang selaras dengan modul lain (seperti pendekatan pengolahan *Model Events* atau langsung dalam aksi *Controller*, tergantung pada pola apa yang *existing*).
   - Pastikan tidak ada fungsi yang menyimpang dari format dan konvensi *backend* saat ini.

4. **Validasi Kriteria Penerimaan:**
   - Bukti pembayaran tercatat akurat.
   - Status di `bookings` terintegrasi 1-to-1 dengan status pada riwayat `payments`.
