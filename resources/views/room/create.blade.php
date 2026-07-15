<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('room.store') }}" method="post" class="form">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="room_number" class="form-label required">Nomor Kamar</label>
                    <input class="form-control @error('room_number') is-invalid @enderror" type="text" id="room_number"
                        name="room_number" required value="{{ old('room_number') }}">
                    @error('room_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label required">Tipe Kamar</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Pilih Tipe</option>
                        <option value="Standard" @selected(old('type') == 'Standard')>Standard</option>
                        <option value="Deluxe" @selected(old('type') == 'Deluxe')>Deluxe</option>
                        <option value="Suite" @selected(old('type') == 'Suite')>Suite</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="price_per_night" class="form-label required">Harga per Malam</label>
                    <input class="form-control @error('price_per_night') is-invalid @enderror" type="number" step="0.01" id="price_per_night"
                        name="price_per_night" required value="{{ old('price_per_night') }}">
                    @error('price_per_night')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="is_available" class="form-label required">Status Ketersediaan</label>
                    <select class="form-select @error('is_available') is-invalid @enderror" id="is_available" name="is_available" required>
                        <option value="1" @selected(old('is_available') == '1')>Tersedia</option>
                        <option value="0" @selected(old('is_available') == '0')>Tidak Tersedia</option>
                    </select>
                    @error('is_available')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Deskripsi Kamar</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('room.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
