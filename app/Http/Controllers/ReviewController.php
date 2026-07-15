<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // ==========================================
    // BAGIAN ADMIN
    // ==========================================
    public function index()
    {
        return view('review.index', [
            'title' => 'Manajemen Ulasan',
            'reviews' => Review::with(['user', 'room', 'booking'])->latest()->get()
        ]);
    }

    // ==========================================
    // BAGIAN GUEST
    // ==========================================
    public function myReviews()
    {
        $pendingReviews = Booking::with('room')
            ->where('user_id', Auth::id())
            ->where('status', 'CONFIRMED')
            ->doesntHave('review')
            ->latest()
            ->get();

        $completedReviews = Review::with('room')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('review.guest_index', [
            'title' => 'Ulasan Saya',
            'pendingReviews' => $pendingReviews,
            'completedReviews' => $completedReviews
        ]);
    }

    public function create(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'CONFIRMED') {
            return to_route('booking.history')->withErrors('Pemesanan ini tidak dapat diulas.');
        }

        if ($booking->review) {
            return to_route('booking.history')->withErrors('Anda sudah memberikan ulasan untuk pesanan ini.');
        }

        return view('review.create', [
            'title' => 'Beri Ulasan',
            'booking' => $booking,
        ]);
    }

    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'CONFIRMED' || $booking->review) {
            return to_route('booking.history')->withErrors('Pemesanan ini tidak valid untuk diulas.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'room_id' => $booking->room_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return to_route('booking.history')->withSuccess('Terima kasih! Ulasan Anda berhasil disimpan.');
    }
}
