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
    		'asset_status' => 1,
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
                'asset_status' => $request->asset_status,
                ]);
 
    	return redirect('/asset');
    }

    public function delete(Request $request) {
        Asset::where('asset_id', $request->asset_id)
            ->update(['is_active' => 0]);
 
    	return redirect('/asset');
    }

    public function showApi() {
        $data = Asset::where('is_active', 1)
               ->get();
        return response()->json($data, 200);
    }

    public function showApiType($type) {
        if ($type == 0) {
            $data = Asset::where('is_active', 1)
                ->get();
        } else {
            $data = Asset::where('is_active', 1)
                ->where("asset_type", $type)    //1 Kendaraan 2 Ponsel
                ->get();
        }
        return response()->json($data, 200);
    }

    public function showApiByID($id) {
        $data = Asset::where('asset_id', $id)
               ->get();
        return response()->json($data, 200);
    }

    public function createApi(Request $request) {
        $data = Asset::create([
    		'asset_name' => $request->asset_name,
    		'asset_type' => $request->asset_type,
    		'asset_unique' => $request->asset_unique,
    		'asset_year' => $request->asset_year,
    		'asset_status' => 1,
    		'is_active' => 1
    	]);
 
        return response()->json($data, 200);
    }

    public function updateApi(Request $request) {
        $data = Asset::where('asset_id', $request->asset_id)
            ->update([
                'asset_name' => $request->asset_name,
                'asset_type' => "1",
                'asset_unique' => $request->asset_unique,
                'asset_year' => "99",
                'asset_status' => "1",
                ]);
 
        return response()->json($data, 200);
    }
}
