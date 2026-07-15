<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <h2 class="text-center mb-4">Daftar Kamar Tersedia</h2>
        
        <div class="row g-4">
            @forelse ($rooms as $room)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Kamar {{ $room->room_number }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $room->type }}</h6>
                            <p class="card-text text-primary fw-bold fs-5 mb-1">Rp {{ number_format($room->price_per_night, 2, ',', '.') }} <small class="text-muted fw-normal fs-6">/ malam</small></p>
                            
                            <div class="mb-2">
                                @if($room->reviews_count > 0)
                                    <span class="text-warning">
                                        {{ str_repeat('⭐', round($room->reviews_avg_rating)) }}
                                    </span>
                                    <small class="text-muted">({{ number_format($room->reviews_avg_rating, 1) }} dari {{ $room->reviews_count }} ulasan)</small>
                                @else
                                    <small class="text-muted fst-italic">Belum ada ulasan</small>
                                @endif
                            </div>
                            <p class="card-text mt-3">{{ Str::limit($room->description, 100) ?: 'Deskripsi kamar tidak tersedia.' }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0 pb-3">
                            @auth
                                @if(auth()->user()->role == 'GUEST')
                                    <a href="{{ route('booking.create', $room) }}" class="btn btn-primary w-100">Pesan Kamar</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Login untuk Pesan</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Maaf, saat ini belum ada kamar yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app>
