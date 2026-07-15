<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg bg-warning text-dark h-100">
                <div class="card-body text-center d-flex flex-column justify-content-center py-5">
                    <i class="bx bx-award display-1 mb-3"></i>
                    <h4>Total Poin Anda</h4>
                    <h1 class="display-4 fw-bold">{{ $total_points }}</h1>
                    <p class="mb-0">Poin dapat digunakan untuk potongan harga saat pemesanan kamar.</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-lg h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Riwayat Transaksi Poin</h5>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Jumlah Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($points as $point)
                                    <tr>
                                        <td>{{ $point->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $point->description ?? '-' }}</td>
                                        <td>
                                            @if($point->transaction_type == 'EARNED')
                                                <span class="badge bg-success">DIPEROLEH</span>
                                            @else
                                                <span class="badge bg-danger">DITUKAR</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold {{ $point->transaction_type == 'EARNED' ? 'text-success' : 'text-danger' }}">
                                            {{ $point->transaction_type == 'EARNED' ? '+' : '-' }}{{ $point->points }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada riwayat transaksi poin.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
