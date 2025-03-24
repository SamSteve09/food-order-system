<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    // Get all staff members
    public function index()
    {
        return response()->json(Staff::all());
    }

    // Create a new staff member
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15',
            'username' => 'required|string|max:50|unique:staff,username',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:cashier,supervisor,owner',
            'store_id' => 'required|exists:stores,id'
        ]);

        $staff = Staff::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password_hash' => Hash::make($request->password),
            'role' => $request->role,
            'store_id' => $request->store_id
        ]);

        return response()->json($staff, 201);
    }

    // Get a specific staff member
    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return response()->json($staff);
    }

    // Update a staff member
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:15',
            'username' => 'nullable|string|max:50|unique:staff,username,' . $staff->id,
            'password' => 'nullable|string|min:6',
            'role' => 'nullable|string|in:cashier,supervisor,owner',
            'store_id' => 'nullable|exists:stores,id'
        ]);

        if ($request->has('password')) {
            $request->merge(['password_hash' => Hash::make($request->password)]);
        }

        $staff->update($request->only(['name', 'phone_number', 'username', 'password_hash', 'role', 'store_id']));

        return response()->json($staff);
    }

    // Delete a staff member
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return response()->json(['message' => 'Staff deleted successfully']);
    }
}
