<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px;">
        <h4 class="mb-4">Tambah Layanan Baru</h4>

        <form action="{{ route('additional-service.store') }}" method="post" class="form">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label required fw-bold">Nama Layanan</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label required fw-bold">Harga (Rp)</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required min="0">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('additional-service.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary ms-2">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
