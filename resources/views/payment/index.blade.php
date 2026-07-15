<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <h4 class="mb-4">Kelola Pembayaran</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Tamu</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Metode</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->booking->user->name }}</td>
                            <td>Rp {{ number_format($payment->amount, 2, ',', '.') }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ $payment->payment_date ? $payment->payment_date->format('d M Y H:i') : '-' }}</td>
                            <td>
                                @if($payment->status == 'SUCCESS')
                                    <span class="badge bg-success">SUCCESS</span>
                                @elseif($payment->status == 'FAILED')
                                    <span class="badge bg-danger">FAILED</span>
                                @else
                                    <span class="badge bg-warning text-dark">PENDING</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.payment.updateStatus', $payment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                        <option value="PENDING" {{ $payment->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                        <option value="SUCCESS" {{ $payment->status == 'SUCCESS' ? 'selected' : '' }}>SUCCESS</option>
                                        <option value="FAILED" {{ $payment->status == 'FAILED' ? 'selected' : '' }}>FAILED</option>
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
