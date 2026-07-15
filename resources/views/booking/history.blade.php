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
                                        <span class="text-success small d-block mb-1">Sudah Diulas</span>
                                    @else
                                        <a href="{{ route('review.create', $booking) }}" class="btn btn-sm btn-outline-success d-block mb-1">Beri Ulasan</a>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-outline-danger d-block w-100" data-bs-toggle="modal" data-bs-target="#maintenanceModal" onclick="setMaintenanceRoom({{ $booking->room_id }}, '{{ $booking->room->room_number }}')">
                                        Lapor Masalah
                                    </button>
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

    <!-- Modal Lapor Masalah -->
    <div class="modal fade" id="maintenanceModal" tabindex="-1" aria-labelledby="maintenanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('maintenance.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="maintenanceModalLabel">Lapor Masalah Kamar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Kamar: <strong id="maintenance-room-number"></strong></p>
                        <input type="hidden" name="room_id" id="maintenance-room-id">
                        
                        <div class="mb-3">
                            <label for="issue_description" class="form-label required">Jelaskan Kendala (mis: AC Bocor, Lampu Mati)</label>
                            <textarea class="form-control" id="issue_description" name="issue_description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function setMaintenanceRoom(roomId, roomNumber) {
            document.getElementById('maintenance-room-id').value = roomId;
            document.getElementById('maintenance-room-number').textContent = roomNumber;
        }
    </script>
    @endpush
</x-app>
