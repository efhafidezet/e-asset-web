<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use Carbon\Carbon;

class TrackCtrl extends Controller
{
    public function show($id) {
        return view('pages.maps', compact('id'));
        return view('pages.maps');
    }

    public function sendTrackedLocation(Request $request) {
        $data = Track::create([
    		'borrow_id' => $request->borrow_id,
    		'track_time' => Carbon::now()->toDateTimeString(),
    		'latitude' => $request->latitude,
    		'longitude' => $request->longitude
    	]);

        return response()->json($data, 200);

        // $earthRadius = 6371000;             //in meters
        // // convert from degrees to radians
        // $latFrom = deg2rad('-6.3657999');
        // $lonFrom = deg2rad('106.8343395');
        // $latTo = deg2rad('-6.372998');
        // $lonTo = deg2rad('106.834803');

        // $latDelta = $latTo - $latFrom;
        // $lonDelta = $lonTo - $lonFrom;

        // $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        //     cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        // return $angle * $earthRadius ." Meters";
    }

    public function getTrackedLocation($id) {
        $data = Track::where('borrow_id', $id)
        ->orderBy('track_time', 'desc')
        ->limit(1)
        ->get();
        return response()->json($data, 200);
    }

    public function showTracker($id) {
        // return view('pages.test_track');
        return view('pages.test_track', compact('id'));
    }




    // public function assignment() {
    //     return view('pages.assignment.view');
    // }

    // public function location() {
    //     return view('pages.location.view');
    // }

    // public function asset() {
    //     return view('pages.asset.view');
    // }

    // public function report() {
    //     return view('pages.report.view');
    // }

    // public function user() {
    //     return view('pages.user.view');
    // }
}
