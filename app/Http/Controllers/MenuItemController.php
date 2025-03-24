<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MenuItemController extends Controller
{
    // Display a listing of the menu items
    public function index()
    {
        // Fetch all menu items
        $menuItems = MenuItem::all();

        return response()->json($menuItems);
    }

    // Store a newly created menu item
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|string|max:50',
            'order_frequency' => 'required|integer',
            'availability' => 'required|boolean',
            'image' => 'required|string',
        ]);

        // Create a new menu item
        $menuItem = MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'order_frequency' => $request->order_frequency,
            'availability' => $request->availability,
            'image' => $request->image,
            'date_added' => now(),
        ]);

        return response()->json($menuItem, 201);
    }

    // Display a specific menu item
    public function show($id)
    {
        // Find menu item by ID
        $menuItem = MenuItem::findOrFail($id);

        return response()->json($menuItem);
    }

    // Update the specified menu item
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'category' => 'nullable|string|max:50',
            'order_frequency' => 'nullable|integer',
            'availability' => 'nullable|boolean',
            'image' => 'nullable|string',
        ]);

        // Find and update menu item
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->update($request->only([
            'name',
            'description',
            'price',
            'category',
            'order_frequency',
            'availability',
            'image',
        ]));

        return response()->json($menuItem);
    }

    // Remove the specified menu item
    public function destroy($id)
    {
        // Find and delete the menu item
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();

        return response()->json(['message' => 'Menu item deleted successfully']);
    }
    public function getMostPopular()
    {
        // Get the top 10 most ordered menu items
        /*$popularItems = Cache::remember('popular_menu_items', now()->addHours(24), function() {
            return MenuItem::orderBy('order_frequency', 'desc')->take(10)->get();
        });*/
        $popularItems = MenuItem::orderBy('order_frequency', 'desc')
            ->take(10)
            ->get();
        return response()->json($popularItems);
        //return view('menu-items.index', compact('popularItems'));
    }
    public function getNewest()
    {
        /*$newestItems = Cache::remember('popular_menu_items', now()->addHours(24), function() {
            return MenuItem::orderBy('date_added', 'desc')->take(10)->get();
        });*/
        $newestItems = MenuItem::orderBy('menu_item_date', 'desc')
            ->take(10)
            ->get();
        return response()->json($newestItems);
    }
    public function getHighlyRated()
    {
        $highlyRatedItems = MenuItem::orderBy('rating', 'desc')
            ->take(10)
            ->get();

        return response()->json($highlyRatedItems);
    }
    // Get the menu items grouped by category
    public function getMenuItemsByCategory(string $category)
    {
        // Fetch menu items by category
        $menuItems = MenuItem::where('category', $category)->get();

        return response()->json($menuItems);
    }
        
}
