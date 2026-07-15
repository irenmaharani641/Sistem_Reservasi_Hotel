<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0">Manajemen Layanan Tambahan</h4>
            <a href="{{ route('additional-service.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Layanan</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Layanan</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $service->name }}</td>
                            <td>{{ Str::limit($service->description, 50) }}</td>
                            <td>Rp {{ number_format($service->price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('additional-service.edit', $service) }}" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil"></i> Edit</a>
                                <button type="button" class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="$('#form-delete').attr('action', '{{ route('additional-service.destroy', $service) }}')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
