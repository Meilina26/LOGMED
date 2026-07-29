<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Gedung;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
        public function create(): View
        {
            $gedung = Gedung::all();
            return view('auth.register', compact('gedung'));
        }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required','string','max:100'],
            'email' => ['required','email','unique:users,email'],
            'id_gedung' => ['required','exists:gedung,id'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $jumlahUser = User::where('id_gedung', $request->id_gedung)->count();
        if ($jumlahUser >= 4) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_gedung' => 'Gedung yang anda dipilih sudah memiliki maksimal 4 pengguna.'
                ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user_gedung',
            'id_gedung' => $request->id_gedung,
        ]);

        event(new Registered($user));

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login menggunakan akun Anda.');   
                 
        if ($user->role == 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect(route('petugas.dashboard', absolute: false));
    }
}
