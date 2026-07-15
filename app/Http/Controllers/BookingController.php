<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\AdditionalService;
use App\Models\BookingService;
use App\Models\Promotion;
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
            'additional_services' => AdditionalService::all(),
        ]);
    }

    public function store(Request $request, Room $room)
    {
        $data = $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'services' => 'nullable|array',
            'services.*.id' => 'required|exists:additional_services,id',
            'services.*.quantity' => 'required|integer|min:1',
            'promotion_code' => 'nullable|string'
        ]);

        $checkIn = Carbon::parse($data['check_in_date']);
        $checkOut = Carbon::parse($data['check_out_date']);

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
        $discountAmount = 0;
        $promotionId = null;

        if (!empty($data['promotion_code'])) {
            $promo = Promotion::where('code', strtoupper($data['promotion_code']))->first();
            if (!$promo) {
                return back()->withErrors(['promotion_code' => 'Kode promo tidak ditemukan.'])->withInput();
            }
            if (Carbon::parse($promo->valid_until)->isPast()) {
                return back()->withErrors(['promotion_code' => 'Kode promo sudah kadaluarsa.'])->withInput();
            }

            $discountAmount = ($totalPrice * $promo->discount_percentage) / 100;
            if ($discountAmount > $promo->max_discount) {
                $discountAmount = $promo->max_discount;
            }
            $promotionId = $promo->id;
            $totalPrice -= $discountAmount;
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'total_price' => $totalPrice,
            'status' => 'PENDING',
            'promotion_id' => $promotionId,
        ]);

        if (!empty($data['services'])) {
            $additionalTotal = 0;
            foreach ($data['services'] as $serviceData) {
                $service = AdditionalService::find($serviceData['id']);
                if ($service && $serviceData['quantity'] > 0) {
                    $serviceTotal = $service->price * $serviceData['quantity'];
                    BookingService::create([
                        'booking_id' => $booking->id,
                        'additional_service_id' => $service->id,
                        'quantity' => $serviceData['quantity'],
                        'total_price' => $serviceTotal
                    ]);
                    $additionalTotal += $serviceTotal;
                }
            }
            $booking->update(['total_price' => $totalPrice + $additionalTotal]);
        }

        return to_route('booking.history')->withSuccess('Pesanan berhasil dibuat!');
    }

    public function history()
    {
        return view('booking.history', [
            'title' => 'Riwayat Pesanan',
            'bookings' => Booking::with(['room', 'payment', 'review', 'bookingServices.additionalService', 'promotion'])->where('user_id', Auth::id())->latest()->get(),
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
