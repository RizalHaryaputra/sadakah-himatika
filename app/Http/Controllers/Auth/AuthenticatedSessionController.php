<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SweetAlert2\Laravel\Swal;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // SweetAlert untuk menampilkan pesan sukses
        Swal::success([
            'title' => 'Login berhasil',
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonColor' => '#1f2937',
            'timer' => 3000,
        ]);

        if (Auth::user()->hasRole('Super Admin')) {
            // Jika pengguna adalah admin, redirect ke halaman admin
            return redirect()->intended(route('admin.dashboard-admin', absolute: false));
        } elseif (Auth::user()->hasRole('Operator Padukuhan')) {
            // Jika pengguna adalah operator padukuhan, redirect ke halaman dashboard operator
            return redirect()->intended(route('admin.dashboard-operator', absolute: false));
        } else {
            // Jika bukan admin, redirect ke halaman dashboard atau halaman lain yang sesuai
            return redirect()->intended(route('nasabah.dashboard', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
