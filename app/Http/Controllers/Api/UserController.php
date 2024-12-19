<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::where('role', 'customer')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $customer = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'customer',
        ]);

        return response()->json(['message' => 'Customer created', 'data' => $customer], 201);
    }

    public function show($id)
    {
        // Menampilkan detail customer berdasarkan ID
        $customer = User::where('role', 'customer')->find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return response()->json($customer, 200);
    }

    public function update(Request $request, $id)
    {
        // Update data customer
        $customer = User::where('role', 'customer')->find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->update($request->only(['name', 'email']));
        return response()->json(['message' => 'Customer updated', 'data' => $customer], 200);
    }

    public function destroy($id)
    {
        // Hapus customer
        $customer = User::where('role', 'customer')->find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted'], 200);
    }
}
