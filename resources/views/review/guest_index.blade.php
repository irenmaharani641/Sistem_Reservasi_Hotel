<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-lg p-3">
                <h5 class="mb-4 text-warning fw-bold"><i class="bi bi-bell"></i> Menunggu Ulasan Anda</h5>
                @if($pendingReviews->isEmpty())
                    <p class="text-muted text-center py-4">Semua pesanan Anda sudah diulas. Terima kasih!</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Kamar</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingReviews as $booking)
                                    <tr>
                                        <td><strong>{{ $booking->room->room_number }}</strong> ({{ $booking->room->type }})</td>
                                        <td>{{ $booking->check_in_date->format('d M Y') }}</td>
                                        <td>{{ $booking->check_out_date->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('review.create', $booking) }}" class="btn btn-sm btn-primary">Beri Ulasan Sekarang</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-lg p-3">
                <h5 class="mb-4 text-success fw-bold"><i class="bi bi-star"></i> Riwayat Ulasan Anda</h5>
                @if($completedReviews->isEmpty())
                    <p class="text-muted text-center py-4">Anda belum memberikan ulasan apa pun.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th>Kamar</th>
                                    <th>Rating</th>
                                    <th>Komentar</th>
                                    <th>Waktu Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedReviews as $review)
                                    <tr>
                                        <td><strong>{{ $review->room->room_number }}</strong></td>
                                        <td>
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                @else
                                                    <i class="bi bi-star text-secondary"></i>
                                                @endif
                                            @endfor
                                        </td>
                                        <td>{{ $review->comment ?: '-' }}</td>
                                        <td>{{ $review->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app>
