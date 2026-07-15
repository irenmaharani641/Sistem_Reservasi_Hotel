<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px;">
        <h4 class="mb-4">Edit Kupon Promosi</h4>

        <form action="{{ route('promotion.update', $promotion) }}" method="post" class="form">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="code" class="form-label required fw-bold">Kode Promo</label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $promotion->code) }}" required style="text-transform:uppercase">
                @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="discount_percentage" class="form-label required fw-bold">Diskon (%)</label>
                    <input type="number" class="form-control @error('discount_percentage') is-invalid @enderror" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage', $promotion->discount_percentage) }}" required min="1" max="100" step="0.01">
                    @error('discount_percentage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="max_discount" class="form-label required fw-bold">Maksimal Potongan (Rp)</label>
                    <input type="number" class="form-control @error('max_discount') is-invalid @enderror" id="max_discount" name="max_discount" value="{{ old('max_discount', $promotion->max_discount) }}" required min="0">
                    @error('max_discount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="valid_until" class="form-label required fw-bold">Berlaku Sampai Tanggal</label>
                <input type="date" class="form-control @error('valid_until') is-invalid @enderror" id="valid_until" name="valid_until" value="{{ old('valid_until', $promotion->valid_until) }}" required>
                @error('valid_until')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('promotion.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary ms-2">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app>
