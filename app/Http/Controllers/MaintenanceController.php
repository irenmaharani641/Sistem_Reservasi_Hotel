<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    // ==========================================
    // BAGIAN ADMIN
    // ==========================================
    public function index()
    {
        return view('maintenance.index', [
            'title' => 'Manajemen Pemeliharaan',
            'maintenances' => Maintenance::with(['room', 'reportedBy'])->latest()->get()
        ]);
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'status' => 'required|in:PENDING,IN_PROGRESS,RESOLVED'
        ]);

        $maintenance->update(['status' => $request->status]);

        return back()->withSuccess('Status pemeliharaan berhasil diperbarui.');
    }

    // ==========================================
    // BAGIAN GUEST
    // ==========================================
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'issue_description' => 'required|string|max:1000'
        ]);

        Maintenance::create([
            'room_id' => $request->room_id,
            'reported_by_user_id' => Auth::id(),
            'issue_description' => $request->issue_description,
            'status' => 'PENDING'
        ]);

        return back()->withSuccess('Laporan masalah berhasil dikirim. Staf kami akan segera memeriksanya.');
    }
}
