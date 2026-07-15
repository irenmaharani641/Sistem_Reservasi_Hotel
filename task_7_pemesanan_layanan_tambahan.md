# Task 7: Pemesanan Layanan Tambahan (Booking Services)

## Tujuan
Menyambungkan reservasi tamu dengan layanan ekstra (seperti pada Task 6).

## Spesifikasi Berdasarkan PRD
- Tabel **BOOKING_SERVICES** (Pivot table) memerlukan struktur kolom: 
  - `id` (Primary Key)
  - `booking_id` (Foreign Key ke tabel bookings)
  - `service_id` (Foreign Key ke tabel additional_services)
  - `quantity` (Integer)
  - `total_price` (Decimal)

## Instruksi Teknis Pelaksanaan
1. **Penyesuaian Struktur Database (Migration):**
   - Buat file migrasi tabel perantara `booking_services`.
   
2. **Pembuatan Seeder Data Dummy:**
   - Buat `BookingServiceSeeder` yang secara acak menambahkan layanan tambahan ke dalam *booking* yang sudah ada.

3. **Logika Fitur Transaksional:**
   - Sesuaikan alur pemesanan *booking* agar dapat menyertakan satu atau lebih *additional services*, lalu perbarui akumulasi total harga pada `bookings.total_price`.
   - Jangan ngoding dulu, gunakan pola integrasi yang sama seperti relasi *booking* dan kamar.
