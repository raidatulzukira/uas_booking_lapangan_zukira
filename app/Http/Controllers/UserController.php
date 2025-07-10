<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Menampilkan halaman profil dari user yang sedang login.
     */
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Menampilkan halaman untuk mengedit profil.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Memperbarui data profil user.
     */
     public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:15',
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk foto
        ]);

        $updateData = $request->only('name', 'email', 'phone', 'bio');

        // Cek jika ada file foto baru yang di-upload
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan foto baru dan dapatkan path-nya
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $updateData['profile_photo_path'] = $path;
        }

        $user->update($updateData);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
    /**
     * Menampilkan halaman untuk mengubah password.
     */
    public function changePassword()
    {
        return view('profile.update'); // Menggunakan view 'update.blade.php' yang Anda buat
    }

    /**
     * Memperbarui password user.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Password berhasil diubah!');
    }
}
