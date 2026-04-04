<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(): View
    {
        return view('users.index');
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('users.index', ['create' => 1]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'role' => ['required', Rule::in(['admin', 'customer'])],
            'verification_status' => ['required', Rule::in(['verified', 'unverified'])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'email_verified_at' => $validated['verification_status'] === 'verified' ? now() : null,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user): RedirectResponse
    {
        return redirect()->route('users.index', ['edit' => $user->id]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin', 'customer'])],
            'verification_status' => ['required', Rule::in(['verified', 'unverified'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ((int) $user->id === (int) auth()->id() && $validated['role'] !== 'admin') {
            return back()->with('error', 'Role akun yang sedang dipakai tidak boleh diubah menjadi customer.');
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->email_verified_at = $validated['verification_status'] === 'verified' ? ($user->email_verified_at ?? now()) : null;

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ((int) $user->id === (int) auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Akun yang sedang login tidak bisa dihapus.');
        }

        try {
            $user->delete();
        } catch (\Throwable $exception) {
            return redirect()->route('users.index')->with('error', 'User tidak bisa dihapus karena masih terkait data lain.');
        }

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}

