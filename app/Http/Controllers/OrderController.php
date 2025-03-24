<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;


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
            'total_price' => 'required|numeric', // Total price
            'store_table_id' => 'required|exists:store_tables,id', // Store table ID should exist
            'customer_id' => 'nullable|exists:customers,id', // Customer ID should exist if provided
        ]);
    
        foreach ($request->items as $item) {
            $subtotal = $item['quantity'] * $item['price']; // Calculate the subtotal
            $total_price += $subtotal; // Add to the total price
            // Add item to the order items array (for later saving)
            $orderItems[] = [
                'menu_item_id' => $item['menu_item_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $subtotal,
            ];
        }
        $order = Order::create([
            'total_price' => $total_price,
            'status' => 'pending',
            'store_table_id' => $request->store_table_id,
            'customer_id' => $request->customer_id,
        ]);
            // Associate the order items with the created order
        foreach ($orderItems as $orderItem) {
            $order->items()->create($orderItem); // Save each order item with the order_id
        }
    
        // Return the created order along with order items
        return response()->json([
            'order' => $order,
            'items' => $order->items
        ]);
    }
    

    public function getOrder($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }
}

