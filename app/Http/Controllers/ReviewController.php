<?php

namespace App\Http\Controllers;

use App\Models\ZukiraReview;
use App\Models\ZukiraBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = ZukiraReview::latest()->get();
        return view('review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */

    // public function create()
    // {
    //     return view('review.create');
    // }

//     public function create()
// {
//     $user = Auth::user();

//     // Ambil lapangan yang pernah dibooking user (tanpa duplikat)
//     $bookedLapangan = $user->bookings()
//         ->with('lapangan')
//         ->get()
//         ->pluck('lapangan')
//         ->unique('id')
//         ->values();

//     return view('review.create', compact('bookedLapangan'));
// }

public function create()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $bookedLapangan = $user->bookings()
        ->with('lapangan')
        ->get()
        ->pluck('lapangan')
        ->unique('id')
        ->values();

    return view('review.create', compact('bookedLapangan'));
}



    /**
     * Store a newly created resource in storage.
     */

//     public function store(Request $request)
// {
//     // Validasi apakah user sudah melakukan booking
//     if (!Auth::user()->hasBooking()) {
//         return redirect()->back()->with('error', 'Anda belum melakukan booking');
//     }

//     // Validasi input
//     $request->validate([
//         'lapangan_id' => 'required|exists:zukira_lapangans,id',
//         'komentar' => 'required',
//         'rating' => 'required|integer|min:1|max:5',
//     ]);

//     // Simpan review
//     ZukiraReview::create([
//         'user_id' => Auth::id(),
//         'lapangan_id' => $request->lapangan_id,
//         'komentar' => $request->komentar,
//         'rating' => $request->rating,
//     ]);

//     return redirect()->route('review.index')->with('success', 'Review berhasil ditambahkan!');
// }

public function store(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user->hasBooking()) {
        return redirect()->back()->with('error', 'Anda belum melakukan booking');
    }

    $request->validate([
        'lapangan_id' => 'required|exists:zukira_lapangans,id',
        'komentar' => 'required',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    ZukiraReview::create([
        'user_id' => $user->id,
        'lapangan_id' => $request->lapangan_id,
        'komentar' => $request->komentar,
        'rating' => $request->rating,
    ]);

    return redirect()->route('review.index')->with('success', 'Review berhasil ditambahkan!');
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
    public function edit($id)
    {
        $review = ZukiraReview::findOrFail($id);
        // Validasi apakah user yang sedang login adalah pemilik review
        if (Auth::id() != $review->user_id) {
            abort(403);
        }
        return view('review.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Retrieve the review by ID
        $review = ZukiraReview::findOrFail($id);

        // Check if the authenticated user is the owner of the review
        if (Auth::id() != $review->user_id) {
            abort(403); // Abort with 403 Forbidden if not authorized
        }

        // Validate the incoming request data
        $request->validate([
            'komentar' => 'required', // Comment is required
            'rating' => 'required|integer|min:1|max:5', // Rating must be an integer between 1 and 5
        ]);

        // Update the review with validated data
        $review->update([
            'komentar' => $request->komentar,
            'rating' => $request->rating,
        ]);

        // Redirect to the review index with a success message
        return redirect()->route('review.index')->with('success', 'Review berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Retrieve the review by ID
        $review = ZukiraReview::findOrFail($id);

        // Check if the authenticated user is the owner of the review
        if (Auth::id() != $review->user_id) {
            // Abort with 403 Forbidden if not authorized
            abort(403);
        }

        // Delete the review
        $review->delete();

        // Redirect to the review index with a success message
        return redirect()->route('review.index')->with('success', 'Review berhasil dihapus!');
    }
}
