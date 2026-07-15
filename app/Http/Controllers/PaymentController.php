<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\LoyaltyPoint;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // ==========================================
    // BAGIAN GUEST / USER BIASA
    // ==========================================

    public function create(Booking $booking)
    {
        // Pastikan hanya bisa dibayar jika status PENDING
        if ($booking->status !== 'PENDING') {
            return to_route('booking.history')->withErrors('Pemesanan ini sudah diproses atau dibatalkan.');
        }

        return view('payment.create', [
            'title' => 'Pembayaran',
            'booking' => $booking,
        ]);
    }

    public function store(Request $request, Booking $booking)
    {
        if ($booking->status !== 'PENDING') {
            return to_route('booking.history')->withErrors('Pemesanan ini sudah diproses atau dibatalkan.');
        }

        $request->validate([
            'payment_method' => 'required|in:Credit Card,Transfer,e-Wallet',
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'payment_method' => $request->payment_method,
            'status' => 'PENDING', // Simulasi menunggu verifikasi admin
        ]);

        return to_route('booking.history')->withSuccess('Bukti pembayaran berhasil dikirim dan menunggu konfirmasi Admin.');
    }

    // ==========================================
    // BAGIAN ADMIN
    // ==========================================

    public function index()
    {
        return view('payment.index', [
            'title' => 'Manajemen Pembayaran',
            'payments' => Payment::with(['booking.user', 'booking.room'])->latest()->get(),
        ]);
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:SUCCESS,FAILED,PENDING',
        ]);

        $payment->update([
            'status' => $request->status,
        ]);

        if ($request->status == 'SUCCESS') {
            $payment->booking->update(['status' => 'CONFIRMED']);
            
            // Tambahkan Loyalty Points (1 poin tiap Rp 10.000)
            $points = floor($payment->amount / 10000);
            if ($points > 0) {
                LoyaltyPoint::create([
                    'user_id' => $payment->booking->user_id,
                    'points' => $points,
                    'transaction_type' => 'EARNED',
                    'description' => 'Poin dari Pesanan Kamar ' . $payment->booking->room->room_number
                ]);
            }
        } elseif ($request->status == 'FAILED') {
            $payment->booking->update(['status' => 'CANCELLED']);
        }

        return back()->withSuccess('Status pembayaran berhasil diperbarui.');
    }
}
