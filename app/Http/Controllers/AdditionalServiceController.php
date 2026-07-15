<?php

namespace App\Http\Controllers;

use App\Models\AdditionalService;
use Illuminate\Http\Request;

class AdditionalServiceController extends Controller
{
    public function index()
    {
        return view('additional-service.index', [
            'title' => 'Layanan Tambahan',
            'services' => AdditionalService::latest()->get()
        ]);
    }

    public function create()
    {
        return view('additional-service.create', [
            'title' => 'Tambah Layanan'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0'
        ]);

        AdditionalService::create($data);

        return to_route('additional-service.index')->withSuccess('Layanan tambahan berhasil ditambahkan.');
    }

    public function show(AdditionalService $additionalService)
    {
        //
    }

    public function edit(AdditionalService $additionalService)
    {
        return view('additional-service.edit', [
            'title' => 'Edit Layanan',
            'service' => $additionalService
        ]);
    }

    public function update(Request $request, AdditionalService $additionalService)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0'
        ]);

        $additionalService->update($data);

        return to_route('additional-service.index')->withSuccess('Layanan tambahan berhasil diperbarui.');
    }

    public function destroy(AdditionalService $additionalService)
    {
        $additionalService->delete();
        return back()->withSuccess('Layanan tambahan berhasil dihapus.');
    }
}
