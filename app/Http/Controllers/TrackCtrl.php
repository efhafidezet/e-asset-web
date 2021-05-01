<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Assignment;
use App\Models\AssetStatus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TrackCtrl extends Controller
{
    public function show($id) {
        return view('pages.maps', compact('id'));
        return view('pages.maps');
    }

    public function sendTrackedLocation(Request $request) {
        $insertdata = Track::create([
    		'borrow_id' => $request->borrow_id,
    		'track_time' => Carbon::now()->toDateTimeString(),
    		'latitude' => $request->latitude,
    		'longitude' => $request->longitude
    	]);

        // return response()->json($data, 200);

        $data = DB::table('borrow')
        ->join('assignment','assignment.assignment_id','=','borrow.assignment_id')
        ->join('asset_status','asset_status.borrow_id','=','borrow.borrow_id')
        ->join('asset','asset.asset_id','=','borrow.asset_id')
        ->join('location','location.location_id','=','assignment.location_id')
        ->join('return','return.borrow_id','=','borrow.borrow_id')
        ->where('borrow.borrow_id', $request->borrow_id)
        ->get();

        $earthRadius = 6371000;             //in meters
        // convert from degrees to radians
        $latFrom = deg2rad($request->latitude);
        $lonFrom = deg2rad($request->longitude);
        $latTo = deg2rad($data[0]->latitude);
        $lonTo = deg2rad($data[0]->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        $calc = $angle * $earthRadius;
        // return $calc ." Meters";

        if ($calc <= $data[0]->radius) {
            AssetStatus::where('borrow_id', $request->borrow_id)->update([
                'asset_status_flag' => 1,
            ]);
        } 

        $resdata = [
            'latFrom' => $request->latitude,
            'lonFrom' => $request->longitude,
            'latTo' => $data[0]->latitude,
            'lonTo' => $data[0]->longitude,
            'calc' => $calc
        ];

        return response()->json($resdata, 200);
        // return response()->json($data, 200);
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
