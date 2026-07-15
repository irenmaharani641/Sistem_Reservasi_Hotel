<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-4">
        <h4 class="mb-4">Formulir Pemesanan</h4>
        
        <div class="mb-4">
            <h5>Detail Kamar</h5>
            <p class="mb-1"><strong>Kamar:</strong> {{ $room->room_number }} ({{ $room->type }})</p>
            <p class="mb-0"><strong>Harga per Malam:</strong> Rp {{ number_format($room->price_per_night, 2, ',', '.') }}</p>
        </div>

        <form action="{{ route('booking.store', $room) }}" method="post" class="form">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="check_in_date" class="form-label required">Tanggal Check-in</label>
                    <input class="form-control @error('check_in_date') is-invalid @enderror" type="date" id="check_in_date"
                        name="check_in_date" required value="{{ old('check_in_date') }}" min="{{ date('Y-m-d') }}">
                    @error('check_in_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="check_out_date" class="form-label required">Tanggal Check-out</label>
                    <input class="form-control @error('check_out_date') is-invalid @enderror" type="date" id="check_out_date"
                        name="check_out_date" required value="{{ old('check_out_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    @error('check_out_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('rooms.public') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
            </div>
        </form>
    </div>
</x-app>
