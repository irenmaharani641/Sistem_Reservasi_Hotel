<div class="row g-3 mb-4">
    <div class="col-md-12">
        <h4 class="fw-bold mb-3">Kamar {{ $room->room_number }}</h4>
        <div class="mb-3">
            <span class="badge bg-primary fs-6">{{ $room->type }}</span>
            @if($room->is_available)
                <span class="badge bg-success fs-6">Tersedia</span>
            @else
                <span class="badge bg-danger fs-6">Tidak Tersedia</span>
            @endif
        </div>
        <div class="list-group list-group-flush">
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-money me-2'></i>Harga/Malam
                    </div>
                    <div class="col-8 fw-semibold">
                        Rp {{ number_format($room->price_per_night, 2, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-align-left me-2'></i>Deskripsi
                    </div>
                    <div class="col-8">
                        {{ $room->description ?: 'Tidak ada deskripsi' }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-calendar-plus me-2'></i>Ditambahkan
                    </div>
                    <div class="col-8">
                        {{ $room->created_at->diffForHumans() }}
                        <small class="text-muted d-block">{{ $room->created_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
