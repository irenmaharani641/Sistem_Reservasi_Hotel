<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-4">
        <h4 class="mb-4">Formulir Pemesanan</h4>
        
        <div class="mb-4">
            <h5>Detail Kamar</h5>
            <p class="mb-1"><strong>Kamar:</strong> {{ $room->room_number }} ({{ $room->type }})</p>
            <p class="mb-0"><strong>Harga per Malam:</strong> Rp {{ number_format($room->price_per_night, 2, ',', '.') }}</p>
        </div>

        <form action="{{ route('booking.store', $room) }}" method="post" class="form">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="check_in_date" class="form-label required">Tanggal Check-in</label>
                    <input class="form-control @error('check_in_date') is-invalid @enderror" type="date" id="check_in_date"
                        name="check_in_date" required value="{{ old('check_in_date') }}" min="{{ date('Y-m-d') }}">
                    @error('check_in_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="check_out_date" class="form-label required">Tanggal Check-out</label>
                    <input class="form-control @error('check_out_date') is-invalid @enderror" type="date" id="check_out_date"
                        name="check_out_date" required value="{{ old('check_out_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    @error('check_out_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">
            <h5 class="mb-3">Layanan Tambahan (Opsional)</h5>
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 50px;">Pilih</th>
                            <th scope="col">Nama Layanan</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col" style="width: 150px;">Kuantitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($additional_services as $index => $service)
                            <tr>
                                <td class="text-center align-middle">
                                    <input class="form-check-input service-checkbox" type="checkbox" name="services[{{ $index }}][id]" value="{{ $service->id }}" id="service_{{ $service->id }}">
                                </td>
                                <td>
                                    <label class="form-check-label d-block fw-bold" for="service_{{ $service->id }}">
                                        {{ $service->name }}
                                    </label>
                                    <small class="text-muted">{{ $service->description }}</small>
                                </td>
                                <td class="align-middle">Rp {{ number_format($service->price, 2, ',', '.') }}</td>
                                <td class="align-middle">
                                    <input type="number" class="form-control service-qty" name="services[{{ $index }}][quantity]" value="1" min="1" disabled>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @push('scripts')
            <script>
                $(document).ready(function() {
                    $('.service-checkbox').on('change', function() {
                        const qtyInput = $(this).closest('tr').find('.service-qty');
                        if ($(this).is(':checked')) {
                            qtyInput.prop('disabled', false);
                        } else {
                            qtyInput.prop('disabled', true);
                            qtyInput.val(1);
                        }
                    });
                });
            </script>
            @endpush
            
            <hr class="my-4">
            <h5 class="mb-3">Kupon Promosi (Opsional)</h5>
            <div class="mb-4">
                <label for="promotion_code" class="form-label">Masukkan Kode Promo</label>
                <input type="text" class="form-control @error('promotion_code') is-invalid @enderror" id="promotion_code" name="promotion_code" value="{{ old('promotion_code') }}" style="text-transform:uppercase; max-width: 300px;">
                @error('promotion_code')
                    <div class="invalid-feedback">{{ $message }}</div>
            </div>

            @if(Auth::user()->total_points > 0)
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="use_points" value="1" id="usePoints">
                    <label class="form-check-label text-success fw-bold" for="usePoints">
                        Gunakan Loyalty Points (Tersedia: {{ Auth::user()->total_points }} Poin)
                    </label>
                    <div class="form-text mt-0">Poin Anda akan memotong harga pesanan (1 Poin = Diskon Rp 1.000).</div>
                </div>
            </div>
            @endif

            <div class="text-end mt-3">
                <a href="{{ route('rooms.public') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
            </div>
        </form>
    </div>
</x-app>
