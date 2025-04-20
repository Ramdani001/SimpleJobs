<?php

namespace App\Http\Controllers;

use App\Models\InventarisCondition;
use App\Models\ProductType;
use Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Inventaris;

class ReportController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;

        $totalProducts = Product::where("created_by", "=", $username)->count();

        $totalInventaris = Inventaris::where("created_by", "=", $username)->count();

        $productTypes = ProductType::where("created_by", "=", $username)->pluck('name');

        $productCounts = Product::where("created_by", "=", $username)
            ->selectRaw('count(*) as count, product_type_id')
            ->groupBy('product_type_id')
            ->pluck('count', 'product_type_id')->toArray();

        $goodCondition = Inventaris::where('condition_id', InventarisCondition::where('name', 'Baik')->first()->id)->count();
        $damagedCondition = Inventaris::where('condition_id', InventarisCondition::where('name', 'Rusak')->first()->id)->count();

        return view('Dashboard.report', compact(
            'totalProducts',
            'totalInventaris',
            'productTypes',
            'productCounts',
            'goodCondition',
            'damagedCondition'
        ));
    }
}
