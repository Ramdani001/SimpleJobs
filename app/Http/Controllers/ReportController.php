<?php

namespace App\Http\Controllers;

use App\Models\InventarisCondition;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $username = Auth::user()->username;

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $productQuery = Product::where("created_by", $username);
        $inventarisQuery = Inventaris::where("created_by", $username);

        if ($startDate && $endDate) {
            $productQuery->whereBetween('created_at', [$startDate, $endDate]);
            $inventarisQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $totalProducts = $productQuery->count();
        $totalInventaris = $inventarisQuery->count();

        $productTypes = ProductType::where("created_by", $username)->pluck('name', 'id');

        $productCounts = [];
        foreach ($productTypes as $typeId => $typeName) {
            $count = (clone $productQuery)->where("product_type_id", $typeId)->count();
            $productCounts[] = $count;
        }

        $baikConditionId = InventarisCondition::where('name', 'Baik')->first()->id;
        $rusakConditionId = InventarisCondition::where('name', 'Rusak')->first()->id;

        $goodCondition = (clone $inventarisQuery)->where('condition_id', $baikConditionId)->count();
        $damagedCondition = (clone $inventarisQuery)->where('condition_id', $rusakConditionId)->count();

        return view('Dashboard.report', compact(
            'totalProducts',
            'totalInventaris',
            'productTypes',
            'productCounts',
            'goodCondition',
            'damagedCondition',
            'startDate',
            'endDate'
        ));
    }

}
