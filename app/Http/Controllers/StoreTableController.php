<?php

namespace App\Http\Controllers;

use App\Models\StoreTable;
use Illuminate\Http\Request;

class StoreTableController extends Controller
{
    // Store a new store table
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'table_qr_code' => 'required|string|max:255|unique:store_tables',
            'table_number' => 'required|integer',
            'store_id' => 'required|exists:stores,id',  // Ensure store exists
        ]);

        // Create a new store table
        $storeTable = StoreTable::create([
            'table_qr_code' => $request->table_qr_code,
            'table_number' => $request->table_number,
            'store_id' => $request->store_id,
        ]);

        return response()->json($storeTable, 201);
    }

    // Get all store tables for a store
    public function index()
    {
        $storeTables = StoreTable::with('store')->get();  // Eager load store relation
        return response()->json($storeTables);
    }

    // Show a specific store table
    public function show($id)
    {
        $storeTable = StoreTable::findOrFail($id);  // Will throw a 404 if not found
        return response()->json($storeTable);
    }

    // Update a store table
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'table_qr_code' => 'nullable|string|max:255|unique:store_tables,table_qr_code,' . $id,
            'table_number' => 'nullable|integer',
            'store_id' => 'nullable|exists:stores,id',
        ]);

        // Find the store table by ID and update it
        $storeTable = StoreTable::findOrFail($id);
        $storeTable->update($request->only(['table_qr_code', 'table_number', 'store_id']));

        return response()->json($storeTable);
    }

    // Delete a store table
    public function destroy($id)
    {
        $storeTable = StoreTable::findOrFail($id);
        $storeTable->delete();

        return response()->json(['message' => 'Store table deleted successfully']);
    }
}
