<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('room.index', [
            'title' => 'Manajemen Kamar',
            'rooms' => Room::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room.create', [
            'title' => 'Tambah Kamar',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number',
            'type' => 'required|in:Standard,Deluxe,Suite',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'required|boolean',
        ]);

        Room::create($validate);

        return to_route('room.index')->withSuccess('Kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('room.show', [
            'title' => 'Detail Kamar',
            'room' => $room,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('room.edit', [
            'title' => 'Edit Kamar',
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validate = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'type' => 'required|in:Standard,Deluxe,Suite',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'required|boolean',
        ]);

        $room->update($validate);

        return to_route('room.index')->withSuccess('Data kamar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return to_route('room.index')->withSuccess('Kamar berhasil dihapus');
    }

    /**
     * Public index for guests
     */
    public function publicIndex()
    {
        return view('public.rooms', [
            'title' => 'Daftar Kamar',
            'rooms' => Room::where('is_available', true)->latest()->get(),
        ]);
    }
}
