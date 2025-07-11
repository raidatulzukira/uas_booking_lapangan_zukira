<?php

namespace App\Http\Controllers;
use App\Models\ZukiraLapangan;
use App\Models\ZukiraReview;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $lapangans = ZukiraLapangan::latest()->take(6)->get();
    //     $reviews = ZukiraReview::with('user', 'lapangan')->latest()->take(3)->get();

    //     return view('landing.index', compact('lapangans', 'reviews'));
    // }

    public function index(Request $request)
    {
        $query = ZukiraLapangan::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
            ->orWhere('tipe', 'like', '%' . $request->search . '%');
        }

        $lapangans = $query->latest()->get();
        $reviews = ZukiraReview::with(['user', 'lapangan'])->latest()->take(5)->get();

        return view('landing.index', compact('lapangans', 'reviews'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
