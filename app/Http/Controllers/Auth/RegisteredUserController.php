<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Padukuhan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $padukuhanPlayen = Padukuhan::all();
        return view('auth.register', compact('padukuhanPlayen'));
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

        $profilePicturePath = null;
        // Cek apakah ada input 'profile_picture' yang dikirim oleh FilePond
        if ($request->filled('profile_picture')) {
            try {
                // FilePond mengirim JSON string yang berisi data base64
                $fileData = json_decode($request->input('profile_picture'), true);

                // Ambil data base64 dari array
                // Formatnya: "data:image/jpeg;base64,....."
                @list($type, $fileData) = explode(';', $fileData['data']);
                @list(, $fileData) = explode(',', $fileData);

                // Buat nama file yang unik
                $fileName = 'profile_pictures/' . Str::random(20) . '.' . ($fileData['type'] ?? 'jpg');

                // Simpan file dari data base64
                Storage::disk('public')->put($fileName, base64_decode($fileData));

                $profilePicturePath = $fileName;
            } catch (\Exception $e) {
                // Jika terjadi error saat decode, abaikan saja dan lanjutkan tanpa gambar
                // Anda bisa menambahkan logging di sini jika perlu
            }
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

        // SweetAlert untuk menampilkan pesan sukses
        Swal::success([
            'title' => 'Registrasi berhasil',
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonColor' => '#1f2937',
            'timer' => 3000,
        ]);
        return redirect()->route('nasabah.dashboard');
    }
}
