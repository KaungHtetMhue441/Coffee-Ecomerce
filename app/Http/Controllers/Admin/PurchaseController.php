<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // Display all purchases
    public function index()
    {
        $purchases = Purchase::all(); // Fetch all purchases
        return view('admin.costs.purchases', compact('purchases'));
    }

    // Store a new purchase
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'purchased_at' => 'nullable|date',
        ]);

        Purchase::create([
            'item_name' => $request->item_name,
            'supplier' => $request->supplier,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'purchased_at' => $request->purchased_at,
        ]);

        return redirect()->route('admin.purchases.index')->with('success', 'Purchase added successfully.');
    }

    // Update an existing purchase
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'purchased_at' => 'nullable|date',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->update([
            'item_name' => $request->item_name,
            'supplier' => $request->supplier,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'purchased_at' => $request->purchased_at,
        ]);

        return redirect()->route('admin.purchases.index')->with('success', 'Purchase updated successfully.');
    }

    // Delete a purchase
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return redirect()->route('admin.purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}
