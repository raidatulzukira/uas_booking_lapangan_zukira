<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($lapangan_id)
    {
        $lapangan = \App\Models\ZukiraLapangan::findOrFail($lapangan_id);
        return view('review.create', compact('lapangan'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:zukira_lapangans,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required'
        ]);

        \App\Models\ZukiraReview::create([
            // 'user_id' => auth()->id(),
            'user_id' => Auth::id(),
            'lapangan_id' => $request->lapangan_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return redirect('/')->with('success', 'Review berhasil dikirim.');
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
