<?php

namespace App\Http\Controllers;

use App\Models\InventarisCondition;
use App\Models\ProductType;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Inventaris;

class ReportController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalInventaris = Inventaris::count();

        $productTypes = ProductType::all()->pluck('name');
        $productCounts = Product::selectRaw('count(*) as count, product_type_id')
            ->groupBy('product_type_id')
            ->pluck('count', 'product_type_id')->toArray();

        $activeProducts = Product::where('is_active', true)->count();
        $inactiveProducts = Product::where('is_active', false)->count();
        $activeInventaris = Inventaris::where('is_active', true)->count();
        $inactiveInventaris = Inventaris::where('is_active', false)->count();

        $goodCondition = Inventaris::where('condition_id', InventarisCondition::where('name', 'Baik')->first()->id)->count();
        $damagedCondition = Inventaris::where('condition_id', InventarisCondition::where('name', 'Rusak')->first()->id)->count();

        return view('Dashboard.report', compact(
            'totalProducts',
            'totalInventaris',
            'productTypes',
            'productCounts',
            'activeProducts',
            'inactiveProducts',
            'activeInventaris',
            'inactiveInventaris',
            'goodCondition',
            'damagedCondition'
        ));
    }
}
