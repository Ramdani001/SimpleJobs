<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\InventarisCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventarisController extends Controller
{
    public function index()
    {
        $listInventaris = Inventaris::with('condition')
            ->where("created_by", "=", Auth::user()->username)
            ->where("is_active", "=", true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $conditions = InventarisCondition::where("is_active", "=", true)
            ->get();

        return view('Dashboard.inventaris', compact('listInventaris', 'conditions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'condition_id' => 'required|exists:inventaris_conditions,id'
        ]);

        $validated["created_by"] = Auth::user()->username;
        $validated["is_active"] = true;

        Inventaris::create($validated);

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'condition_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $inventaris = Inventaris::findOrFail($id);
        $inventaris->update([
            'name' => $request->name,
            'condition_id' => $request->condition_id,
            'quantity' => $request->quantity,
            'is_active' => true,
            'updated_by' => Auth::user()->username,
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
