<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationCtrl extends Controller
{
    public function show() {
        $data = Location::where('is_active', 1)
               ->get();
        return view('pages.location.view', compact('data'));
    }

    public function store(Request $request) {
        Location::create([
    		'location_name' => $request->location_name,
    		'latitude' => $request->latitude,
    		'longitude' => $request->longitude,
    		'is_active' => $request->is_active
    	]);
 
    	return redirect('/location');
    }

    public function update(Request $request) {
        Location::where('location_id', $request->location_id)
            ->update([
                'location_name' => $request->location_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
                ]);
 
    	return redirect('/location');
    }

    public function delete(Request $request) {
        Location::where('location_id', $request->location_id)
            ->update(['is_active' => 0]);
 
    	return redirect('/location');
    }
}
