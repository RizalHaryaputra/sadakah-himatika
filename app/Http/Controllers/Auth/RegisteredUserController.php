<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password'       => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number'   => ['required', 'string', 'max:20'],
            'address'        => ['required', 'string', 'max:255'],
            'padukuhan_id'   => ['required', 'exists:padukuhan,id'],
            'profile_picture' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
        ]);

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public'); // Simpan ke storage/app/public/profile_pictures
        } else {
            $path = 'profile_pictures/profile.png'; // path default
        }

        $user = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'phone_number'    => $request->phone_number,
            'address'         => $request->address,
            'padukuhan_id'    => $request->padukuhan_id,
            'profile_picture' => $path,
            'total_poin'      => 0,
        ]);

        $user->assignRole('Nasabah');

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
