<?php

namespace App\Http\Controllers;

use App\Models\ZukiraLapangan;
use App\Models\ZukiraReview;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     // Untuk admin - tampilkan semua lapangan
    public function index()
    {
        $lapangans = ZukiraLapangan::all();
        return view('lapangan.index', compact('lapangans'));
    }



    // public function index(Request $request)
    // {
    //     $query = \App\Models\ZukiraLapangan::query();

    //     if ($request->has('search')) {
    //         $query->where('nama', 'like', '%' . $request->search . '%');
    //     }

    //     $lapangans = $query->get();
    //     $reviews = \App\Models\ZukiraReview::with(['user', 'lapangan'])->latest()->take(3)->get();

    //     return view('landing', compact('lapangans', 'reviews'));
    // }


    /**
     * Show the form for creating a new resource.
     */
    // Form tambah lapangan
    public function create()
    {
        return view('lapangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Simpan lapangan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tipe' => 'required',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = $request->file('foto')->store('lapangan', 'public');

        ZukiraLapangan::create([
            'nama' => $request->nama,
            'tipe' => $request->tipe,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'foto' => $path
        ]);

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    // Form edit lapangan
    public function edit($id)
    {
        $lapangan = ZukiraLapangan::findOrFail($id);
        return view('lapangan.edit', compact('lapangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Update lapangan
    public function update(Request $request, $id)
    {
        $lapangan = ZukiraLapangan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'tipe' => 'required',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['nama', 'tipe', 'lokasi', 'harga']);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($lapangan->foto);
            $data['foto'] = $request->file('foto')->store('lapangan', 'public');
        }

        $lapangan->update($data);

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Hapus lapangan
    public function destroy($id)
    {
        $lapangan = ZukiraLapangan::findOrFail($id);
        Storage::disk('public')->delete($lapangan->foto);
        $lapangan->delete();

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil dihapus.');
    }

    // Untuk halaman publik
    public function landing(Request $request)
    {
        $query = ZukiraLapangan::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $lapangans = $query->get();
        $reviews = ZukiraReview::with(['user', 'lapangan'])->latest()->take(3)->get();

        return view('landing', compact('lapangans', 'reviews'));
    }

}
