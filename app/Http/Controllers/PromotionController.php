<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        return view('promotion.index', [
            'title' => 'Manajemen Promosi',
            'promotions' => Promotion::latest()->get()
        ]);
    }

    public function create()
    {
        return view('promotion.create', ['title' => 'Tambah Kupon Promosi']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:promotions,code|max:50',
            'discount_percentage' => 'required|numeric|min:1|max:100',
            'max_discount' => 'required|numeric|min:0',
            'valid_until' => 'required|date'
        ]);

        $data['code'] = strtoupper($data['code']);
        Promotion::create($data);

        return to_route('promotion.index')->withSuccess('Kupon Promosi berhasil ditambahkan.');
    }

    public function edit(Promotion $promotion)
    {
        return view('promotion.edit', [
            'title' => 'Edit Kupon Promosi',
            'promotion' => $promotion
        ]);
    }

    public function update(Request $request, Promotion $promotion)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:promotions,code,'.$promotion->id,
            'discount_percentage' => 'required|numeric|min:1|max:100',
            'max_discount' => 'required|numeric|min:0',
            'valid_until' => 'required|date'
        ]);

        $data['code'] = strtoupper($data['code']);
        $promotion->update($data);

        return to_route('promotion.index')->withSuccess('Kupon Promosi berhasil diperbarui.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return back()->withSuccess('Kupon promosi berhasil dihapus.');
    }
}
