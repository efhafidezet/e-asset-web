<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;

class AssetCtrl extends Controller
{
    public function show() {
        $data = Asset::where('is_active', 1)
               ->get();
        return view('pages.asset.view', compact('data'));
    }

    public function store(Request $request) {
        Asset::create([
    		'asset_name' => $request->asset_name,
    		'asset_type' => $request->asset_type,
    		'asset_unique' => $request->asset_unique,
    		'asset_year' => $request->asset_year,
    		'status' => 1,
    		'is_active' => 1
    	]);
 
    	return redirect('/asset');
    }

    public function update(Request $request) {
        Asset::where('asset_id', $request->asset_id)
            ->update([
                'asset_name' => $request->asset_name,
                'asset_type' => $request->asset_type,
                'asset_unique' => $request->asset_unique,
                'asset_year' => $request->asset_year,
                ]);
 
    	return redirect('/asset');
    }

    public function delete(Request $request) {
        Asset::where('asset_id', $request->asset_id)
            ->update(['is_active' => 0]);
 
    	return redirect('/asset');
    }
}
