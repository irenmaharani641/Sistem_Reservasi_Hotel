<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <h4 class="mb-4">Kelola Pesanan Kamar</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Tamu</th>
                        <th scope="col">Kamar</th>
                        <th scope="col">Check-in / Check-out</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->room->room_number }}</td>
                            <td>{{ $booking->check_in_date->format('d M') }} - {{ $booking->check_out_date->format('d M Y') }}</td>
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
                                <form action="{{ route('admin.booking.updateStatus', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                        <option value="PENDING" {{ $booking->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                        <option value="CONFIRMED" {{ $booking->status == 'CONFIRMED' ? 'selected' : '' }}>CONFIRMED</option>
                                        <option value="CANCELLED" {{ $booking->status == 'CANCELLED' ? 'selected' : '' }}>CANCELLED</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
