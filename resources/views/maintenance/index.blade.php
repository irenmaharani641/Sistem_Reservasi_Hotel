<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <h4 class="mb-4">Daftar Laporan Pemeliharaan</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kamar</th>
                        <th scope="col">Pelapor</th>
                        <th scope="col">Keluhan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Waktu Lapor</th>
                        <th scope="col">Waktu Selesai</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maintenances as $maintenance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $maintenance->room->room_number }}</td>
                            <td>{{ $maintenance->reportedBy->name }}</td>
                            <td>{{ $maintenance->issue_description }}</td>
                            <td>
                                @if($maintenance->status == 'PENDING')
                                    <span class="badge bg-warning text-dark">PENDING</span>
                                @elseif($maintenance->status == 'IN_PROGRESS')
                                    <span class="badge bg-info text-dark">IN PROGRESS</span>
                                @else
                                    <span class="badge bg-success">RESOLVED</span>
                                @endif
                            </td>
                            <td>{{ $maintenance->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $maintenance->resolved_at ? \Carbon\Carbon::parse($maintenance->resolved_at)->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <form action="{{ route('admin.maintenance.update', $maintenance) }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                        <option value="PENDING" {{ $maintenance->status == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                        <option value="IN_PROGRESS" {{ $maintenance->status == 'IN_PROGRESS' ? 'selected' : '' }}>In Progress</option>
                                        <option value="RESOLVED" {{ $maintenance->status == 'RESOLVED' ? 'selected' : '' }}>Resolved</option>
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
