<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('products', 'orders', 'reviews');
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone'   => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'bio'     => ['nullable', 'string', 'max:1000'],
            'avatar'  => ['nullable', 'image', 'max:1024'],
            'current_password'      => ['nullable', 'required_with:password'],
            'password'              => ['nullable', 'confirmed', 'min:8'],
            'password_confirmation' => ['nullable'],
        ]);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
            }
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        unset($data['current_password'], $data['password_confirmation']);
        $user->update($data);

        return redirect()->route('profile.show')
            ->with('success', 'Profil mis à jour avec succès !');
    }
}
