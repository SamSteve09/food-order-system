<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $total_price = 0;
        
        $orderItems = [];

        $request->validate([
            'items' => 'required|array', // Expecting an array of items
            'items.*.menu_item_id' => 'required|exists:menu_items,id', // Validate each item
            'items.*.quantity' => 'required|integer|min:1', // Quantity should be at least 1
            'store_table_id' => 'required|exists:store_tables,id', // Store table ID should exist
            'store_id' => 'required|exists:stores,id', // Store ID should exist
            'customer_id' => 'nullable|exists:customers,id', // Customer ID should exist if provided
        ]);
    
        foreach ($request->items as $item) {
            $menuItem = MenuItem::findOrFail($item['menu_item_id']); // Find the menu item
            $subtotal_price = $menuItem->price * $item['quantity'];
            Log::debug($subtotal_price);
            $total_price += $subtotal_price; // Add to the total price
            // Add item to the order items array (for later saving)
            $order_items[] = [
                'menu_item_id' => $item['menu_item_id'],
                'quantity' => $item['quantity'],
                'subtotal_price' => $subtotal_price,
            ];
        }
        DB::beginTransaction();
        try{
            $order = Order::create([
                'total_price' => $total_price,
                'status' => 'pending',
                'store_table_id' => $request->store_table_id,
                'customer_id' => $request->customer_id,
                'store_id' => $request->store_id
            ]);
            // Associate the order items with the created order
            foreach ($order_items as $order_item) {
                $order_item['order_id'] = $order->id;
                OrderItem::create($order_item);
            }
                        // Insert all order items
            if (count($orderItems) > 0) {
                $order->items()->createMany($orderItems); // Use createMany to insert multiple items
            }
            // Return the created order along with order items

            DB::commit();
            return response()->json([
                'order' => $order,
                'order_items' => $order->items
            ],201);
        }catch (\Exception $e) {
            // If an error occurs, rollback the transaction
            DB::rollBack();

            // Return error response with the exception message
            return response()->json([
                'error' => 'Something went wrong while processing the order.',
                'message' => $e->getMessage()
            ], 500);    
    }
    }

    public function index()
    {
        $orders = Order::all();

        return response()->json($orders);
    }

    // Show a single order with its order items
    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);

        return response()->json($order);
    }

    // Update an order's details
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update($request->all());  // Update with the provided data

        return response()->json($order);
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}

