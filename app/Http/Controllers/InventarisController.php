<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\InventarisCondition;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $listInventaris = Inventaris::with('condition')->get();
        $conditions = InventarisCondition::all();
        return view('Dashboard.inventaris', compact('listInventaris', 'conditions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'condition_id' => 'required|exists:inventaris_conditions,id',
            'is_active' => 'boolean',
            'created_by' => 'required|string|max:255',
        ]);

        Inventaris::create($validated);

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'condition_id' => 'required|integer',
            'quantity' => 'required|integer',
            'created_by' => 'required|string|max:255',
        ]);

        $inventaris = Inventaris::findOrFail($id);
        $inventaris->update([
            'Name' => $request->Name,
            'condition_id' => $request->condition_id,
            'quantity' => $request->quantity,
            'is_active' => $request->has('is_active'),
            'created_by' => $request->created_by,
        ]);

        return redirect()->back()->with('success', 'Inventaris berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil dihapus.');
    }
}
