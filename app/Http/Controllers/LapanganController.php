<?php

namespace App\Http\Controllers;

use App\Models\ZukiraLapangan;
use App\Models\ZukiraReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    /**
     * Menampilkan daftar semua lapangan (untuk admin atau halaman utama lapangan).
     */
     public function index(Request $request)
    {
        // 1. Mulai query ke database, JANGAN langsung panggil ->get()
        $query = ZukiraLapangan::query();

        $query->where('status', 'tersedia');


        // 2. Cek jika di URL ada parameter 'tipe' dan isinya bukan 'semua'
        if ($request->filled('tipe') && $request->input('tipe') != 'semua') {
            // Terapkan filter WHERE pada query
            $query->where('tipe', $request->input('tipe'));
        }

         $query->when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->input('search') . '%';
            // Ganti 'nama_lapangan' dan 'lokasi' dengan nama kolom Anda
            return $q->where(function($subQuery) use ($searchTerm) {
                $subQuery->where('nama', 'like', $searchTerm)
                         ->orWhere('lokasi', 'like', $searchTerm); // Contoh jika ingin cari berdasarkan lokasi juga
            });
        });

        
        // 3. Ambil data SETELAH semua filter diterapkan
        // Di sini Anda bisa menambahkan order by, dll.
        $lapangans = $query->latest()->get();

        // 4. Kirim data yang SUDAH DIFILTER ke view
        return view('lapangan.index', [
            'lapangans' => $lapangans
        ]);
    }


    /**
     * Menampilkan form untuk membuat lapangan baru.
     */
    public function create()
    {
        return view('lapangan.create');
    }

    /**
     * Menyimpan lapangan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
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
     * Menampilkan halaman detail untuk satu lapangan.
     * Method ini ditambahkan untuk melengkapi Route::resource.
     */
    public function show($id)
    {
        $lapangan = ZukiraLapangan::findOrFail($id);
        // Anda bisa membuat view 'lapangan.show' jika diperlukan.
        // Untuk saat ini, kita arahkan ke halaman booking.
        return redirect()->route('booking.create', ['lapangan_id' => $lapangan->id]);
    }


    /**
     * Menampilkan form untuk mengedit lapangan.
     */
    public function edit($id)
    {
        $lapangan = ZukiraLapangan::findOrFail($id);
        return view('lapangan.edit', compact('lapangan'));
    }

    /**
     * Memperbarui data lapangan di database.
     */
    public function update(Request $request, $id)
    {
        $lapangan = ZukiraLapangan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->only(['nama', 'tipe', 'lokasi', 'harga']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama sebelum menyimpan yang baru
            if ($lapangan->foto) {
                Storage::disk('public')->delete($lapangan->foto);
            }
            $data['foto'] = $request->file('foto')->store('lapangan', 'public');
        }

        $lapangan->update($data);

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil diupdate.');
    }

    /**
     * Menghapus lapangan dari database.
     */
    public function destroy($id)
    {
        $lapangan = ZukiraLapangan::findOrFail($id);
        
        // Hapus foto dari storage
        if ($lapangan->foto) {
            Storage::disk('public')->delete($lapangan->foto);
        }
        
        $lapangan->delete();

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil dihapus.');
    }

    /**
     * Menampilkan data untuk halaman landing/beranda.
     */
    public function landing(Request $request)
    {
        $query = ZukiraLapangan::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('tipe', 'like', '%' . $request->search . '%');
        }

        $lapangans = $query->get();
        $reviews = ZukiraReview::with(['user', 'lapangan'])->latest()->take(3)->get();

        return view('landing', compact('lapangans', 'reviews'));
    }
}
