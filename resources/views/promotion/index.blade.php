<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0">Manajemen Kupon Promosi</h4>
            <a href="{{ route('promotion.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Promo</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Promo</th>
                        <th scope="col">Diskon (%)</th>
                        <th scope="col">Maksimal Potongan</th>
                        <th scope="col">Berlaku Sampai</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotions as $promo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold text-primary">{{ $promo->code }}</td>
                            <td>{{ $promo->discount_percentage }}%</td>
                            <td>Rp {{ number_format($promo->max_discount, 2, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($promo->valid_until)->format('d M Y') }}</td>
                            <td>
                                @if(\Carbon\Carbon::parse($promo->valid_until)->isPast())
                                    <span class="badge bg-danger">EXPIRED</span>
                                @else
                                    <span class="badge bg-success">ACTIVE</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('promotion.edit', $promo) }}" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil"></i> Edit</a>
                                <button type="button" class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="$('#form-delete').attr('action', '{{ route('promotion.destroy', $promo) }}')">
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
