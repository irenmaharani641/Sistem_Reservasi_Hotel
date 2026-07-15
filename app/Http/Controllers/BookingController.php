<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // ==========================================
    // BAGIAN GUEST / USER BIASA
    // ==========================================

    public function create(Room $room)
    {
        return view('booking.create', [
            'title' => 'Pesan Kamar',
            'room' => $room,
        ]);
    }

    public function store(Request $request, Room $room)
    {
        $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);

        // Cek overlap booking
        $overlappingBookings = Booking::where('room_id', $room->id)
            ->whereIn('status', ['PENDING', 'CONFIRMED'])
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in_date', [$checkIn, $checkOut->copy()->subDay()])
                      ->orWhereBetween('check_out_date', [$checkIn->copy()->addDay(), $checkOut])
                      ->orWhere(function ($q) use ($checkIn, $checkOut) {
                          $q->where('check_in_date', '<=', $checkIn)
                            ->where('check_out_date', '>=', $checkOut);
                      });
            })->count();

        if ($overlappingBookings > 0) {
            return back()->withErrors(['check_in_date' => 'Kamar tidak tersedia pada tanggal tersebut.'])->withInput();
        }

        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price_per_night * $nights;

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'total_price' => $totalPrice,
            'status' => 'PENDING',
        ]);

        return to_route('booking.history')->withSuccess('Pesanan berhasil dibuat!');
    }

    public function history()
    {
        return view('booking.history', [
            'title' => 'Riwayat Pesanan',
            'bookings' => Booking::with('room')->where('user_id', Auth::id())->latest()->get(),
        ]);
    }

    // ==========================================
    // BAGIAN ADMIN
    // ==========================================

    public function index()
    {
        return view('booking.index', [
            'title' => 'Manajemen Pesanan',
            'bookings' => Booking::with(['user', 'room'])->latest()->get(),
        ]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:PENDING,CONFIRMED,CANCELLED',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return back()->withSuccess('Status pesanan berhasil diperbarui.');
    }
}
