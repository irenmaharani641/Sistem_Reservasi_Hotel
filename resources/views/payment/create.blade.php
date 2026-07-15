<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-4 max-w-lg mx-auto" style="max-width: 600px;">
        <h4 class="mb-4 text-center">Konfirmasi Pembayaran</h4>
        
        <div class="alert alert-info">
            <h5 class="alert-heading">Detail Pesanan</h5>
            <p class="mb-1"><strong>Kamar:</strong> {{ $booking->room->room_number }} ({{ $booking->room->type }})</p>
            <p class="mb-1"><strong>Tanggal:</strong> {{ $booking->check_in_date->format('d M Y') }} s/d {{ $booking->check_out_date->format('d M Y') }}</p>
            <p class="mb-0 fs-5 text-dark"><strong>Total Tagihan:</strong> Rp {{ number_format($booking->total_price, 2, ',', '.') }}</p>
        </div>

        <form action="{{ route('payment.store', $booking) }}" method="post" class="form mt-4">
            @csrf
            
            <div class="mb-4">
                <label for="payment_method" class="form-label required fw-bold">Pilih Metode Pembayaran</label>
                <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                    <option value="" selected disabled>-- Pilih Metode --</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Transfer">Bank Transfer</option>
                    <option value="e-Wallet">e-Wallet (OVO, GoPay, Dana)</option>
                </select>
                @error('payment_method')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('booking.history') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success px-4">Kirim Bukti Pembayaran</button>
            </div>
        </form>
    </div>
</x-app>
