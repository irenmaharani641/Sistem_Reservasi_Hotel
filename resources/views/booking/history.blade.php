<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <h4 class="mb-4">Riwayat Pesanan Saya</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kamar</th>
                        <th scope="col">Check-in</th>
                        <th scope="col">Check-out</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $booking->room->room_number }}</strong> ({{ $booking->room->type }})
                                @if($booking->bookingServices->isNotEmpty())
                                    <div class="mt-1 small text-muted">
                                        <span class="fw-bold d-block border-top pt-1 mt-1">Layanan Tambahan:</span>
                                        <ul class="mb-0 ps-3">
                                        @foreach($booking->bookingServices as $bs)
                                            <li>{{ $bs->additionalService->name ?? 'Layanan' }} (x{{ $bs->quantity }})</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if($booking->promotion)
                                    <div class="mt-1 small text-success fw-bold">
                                        <i class="bi bi-tag-fill"></i> Promo: {{ $booking->promotion->code }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $booking->check_in_date->format('d M Y') }}</td>
                            <td>{{ $booking->check_out_date->format('d M Y') }}</td>
                            <td>Rp {{ number_format($booking->total_price, 2, ',', '.') }}</td>
                            <td>
                                @if($booking->status == 'CONFIRMED')
                                    <span class="badge bg-success">CONFIRMED</span>
                                @elseif($booking->status == 'CANCELLED')
                                    <span class="badge bg-danger">CANCELLED</span>
                                @else
                                    <span class="badge bg-warning text-dark">PENDING</span>
                                @endif
                            </td>
                            <td>
                                @if($booking->status == 'PENDING')
                                    @if($booking->payment)
                                        <span class="text-info small">Menunggu Konfirmasi</span>
                                    @else
                                        <a href="{{ route('payment.create', $booking) }}" class="btn btn-sm btn-primary">Bayar Sekarang</a>
                                    @endif
                                @elseif($booking->status == 'CONFIRMED')
                                    @if($booking->review)
                                        <span class="text-success small">Sudah Diulas</span>
                                    @else
                                        <a href="{{ route('review.create', $booking) }}" class="btn btn-sm btn-outline-success">Beri Ulasan</a>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
