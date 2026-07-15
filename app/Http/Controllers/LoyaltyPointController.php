<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyPointController extends Controller
{
    public function index()
    {
        return view('loyalty.index', [
            'title' => 'Riwayat Loyalty Points',
            'points' => LoyaltyPoint::where('user_id', Auth::id())->latest()->get(),
            'total_points' => Auth::user()->total_points
        ]);
    }
}
