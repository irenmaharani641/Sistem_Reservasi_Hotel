<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-4 max-w-lg mx-auto" style="max-width: 600px;">
        <h4 class="mb-4 text-center">Beri Ulasan Kamar</h4>
        
        <div class="alert alert-info">
            <h5 class="alert-heading">Detail Kamar</h5>
            <p class="mb-1"><strong>Kamar:</strong> {{ $booking->room->room_number }} ({{ $booking->room->type }})</p>
            <p class="mb-1"><strong>Tanggal Menginap:</strong> {{ $booking->check_in_date->format('d M Y') }} s/d {{ $booking->check_out_date->format('d M Y') }}</p>
        </div>

        <form action="{{ route('review.store', $booking) }}" method="post" class="form mt-4">
            @csrf
            
            <div class="mb-3">
                <label for="rating" class="form-label required fw-bold">Penilaian (Bintang 1 - 5)</label>
                <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                    <option value="" selected disabled>-- Pilih Rating --</option>
                    <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                    <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                    <option value="3">⭐⭐⭐ (Cukup)</option>
                    <option value="2">⭐⭐ (Kurang)</option>
                    <option value="1">⭐ (Sangat Kurang)</option>
                </select>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label fw-bold">Komentar / Saran (Opsional)</label>
                <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="4" placeholder="Bagaimana pengalaman Anda menginap di kamar ini?">{{ old('comment') }}</textarea>
                @error('comment')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('booking.history') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success px-4">Kirim Ulasan</button>
            </div>
        </form>
    </div>
</x-app>
