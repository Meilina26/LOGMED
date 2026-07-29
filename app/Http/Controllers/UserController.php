<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gedung;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('gedung')
                    ->paginate(10);

        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gedung = Gedung::all();
        return view('user.create', compact('gedung'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => ['required','confirmed',Rules\Password::defaults()],
            'role' => 'required|in:admin,user_gedung',
            'id_gedung' => 'nullable|exists:gedung,id',
        ]);

        if ($request->role == 'user_gedung') {

            $jumlahUser = User::where('id_gedung', $request->id_gedung)->count();

            if ($jumlahUser >= 4) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'id_gedung' => 'Gedung yang dipilih sudah penuh (maksimal 4 user).'
                    ]);
            }
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'id_gedung' => $request->role == 'admin'
                            ? null
                            : $request->id_gedung,
        ]);

        return redirect()
            ->route('user.index')
            ->with('success','User berhasil ditambahkan.');
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
    public function edit(User $user)
    {
        $gedung = Gedung::all();

        return view('user.edit', compact('user', 'gedung'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user_gedung',
            'id_gedung' => 'nullable|exists:gedung,id',
            'password' => 'nullable|confirmed|min:8',
        ]);

        if ($request->role == 'user_gedung') {

            if (!$request->id_gedung) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'id_gedung' => 'Silakan pilih gedung.'
                    ]);
            }

            $jumlahUser = User::where('id_gedung', $request->id_gedung)
                ->where('id', '!=', $user->id)
                ->count();

            if ($jumlahUser >= 4) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'id_gedung' => 'Gedung tersebut sudah penuh (maksimal 4 user).'
                    ]);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->id_gedung = $request->role == 'admin'
                            ? null
                            : $request->id_gedung;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(User $user)
    {
        // Mencegah admin menghapus akunnya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->route('user.index')
                ->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'Data user berhasil dihapus.');
    }
}
