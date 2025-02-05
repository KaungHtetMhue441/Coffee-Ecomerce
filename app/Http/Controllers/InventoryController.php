<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryHistory;
use Carbon\Carbon;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::query();

        if ($request['from_date'] && $request['to_date']) {
            $query->whereBetween('date_added', [$request->from_date, $request->to_date]);
        } else if ($request['date_added']) {
            $query->whereBetween('date_added', [now()->startOfMonth(), now()->endOfMonth()]);
        }

        if ($request['sort_by'] && $request['order']) {
            $query->orderBy($request->sort_by, $request->order);
        }

        if ($request['item_name']) {
            $query->where('item_name', 'like', '%' . $request->item_name . '%');
        }

        $items = $query->get();

        return view('admin.inventory.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $inventory = new Inventory();
        $inventory->item_name = $request->item_name;
        $inventory->description = $request->description;
        $inventory->date_added = Carbon::now();
        $inventory->save();

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item created successfully.');
    }

    public function addQuantity(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $inventory = Inventory::findOrFail($request->item_id);
        $inventory->quantity += $request->quantity;
        $inventory->save();

        InventoryHistory::create([
            'inventory_id' => $inventory->id,
            'quantity' => $request->quantity,
            'date_added' => Carbon::now(),
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Quantity added successfully.');
    }

    public function decreaseQuantity(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $inventory = Inventory::findOrFail($request->item_id);
        if ($inventory->quantity < $request->quantity) {
            return redirect()->route('admin.inventory.index')->with('error', 'Not enough quantity to decrease.');
        }

        $inventory->quantity -= $request->quantity;
        $inventory->save();

        InventoryHistory::create([
            'inventory_id' => $inventory->id,
            'quantity' => -$request->quantity,
            'date_retrieved' => Carbon::now(),
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Quantity decreased successfully.');
    }
    public function create()
    {
        return view('admin.inventory.create');
    }

    public function show($id)
    {
        $item = Inventory::findOrFail($id);
        $item->status = $item->quantity > 0 ? 'In Stock' : 'Out of Stock';
        return view('admin.inventory.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Inventory::findOrFail($id);
        return view('admin.inventory.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->item_name = $request->item_name;
        $inventory->description = $request->description;
        $inventory->save();

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item updated successfully.');
    }
}
