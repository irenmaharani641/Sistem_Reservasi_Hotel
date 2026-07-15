<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <h4 class="mb-4">Daftar Ulasan Tamu</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Tamu</th>
                        <th scope="col">Kamar</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Komentar</th>
                        <th scope="col">Waktu Ulasan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td class="fw-bold">{{ $review->room->room_number }} <span class="fw-normal">({{ $review->room->type }})</span></td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-secondary"></i>
                                    @endif
                                @endfor
                                ({{ $review->rating }}/5)
                            </td>
                            <td>{{ $review->comment ?: '-' }}</td>
                            <td>{{ $review->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
