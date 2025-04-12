<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterParameter;

class SettingsController extends Controller
{
    public function index()
    {
        $targetDevice = MasterParameter::where('code', 'TARGET_DEVICE')->first();
        $financialTarget = MasterParameter::where('code', 'FINANCIAL_TARGET')->first();

        return view('Dashboard.settings', compact('targetDevice', 'financialTarget'));
    }

    public function update(Request $request) {
        $request->validate([
            'target-device' => 'required',
            'financial-target' => 'required',
        ]);
    
        $targetDevice = MasterParameter::where('code', 'TARGET_DEVICE')->first();
        $targetDevice->update([
            'value' => $request->input('target-device'),
        ]);
    
        $financialTarget = MasterParameter::where('code', 'FINANCIAL_TARGET')->first();
        $financialTarget->update([
            'value' => $request->input('financial-target'),
        ]);
    
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
