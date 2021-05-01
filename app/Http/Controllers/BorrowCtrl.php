<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Borrow;
use App\Models\Assignment;
use App\Models\Asset;
use App\Models\ReturnM;
use App\Models\AssetStatus;

class BorrowCtrl extends Controller
{
    public function store(Request $request) {
        $data = Borrow::create([
    		'borrow_date' => Carbon::now()->toDateTimeString(),
    		'assignment_id' => $request->assignment_id,
    		'user_id' => $request->user_id,
    		'asset_id' => $request->asset_id
    	]);

        $getBorrow = Borrow::orderBy('created_at', 'desc')
                ->limit(1)
                ->get();

        ReturnM::create([
            'return_date' => "1970-01-01 00:00:00",
            'borrow_id' => $getBorrow[0]->borrow_id
        ]);

        AssetStatus::create([
            'borrow_id' => $getBorrow[0]->borrow_id,
            'asset_status_flag' => 0
        ]);

        Assignment::where('assignment_id', $request->assignment_id)->update([
                'assignment_status' => 2,
            ]);

        Asset::where('asset_id', $request->asset_id)->update([
                'asset_status' => 0,
            ]);

        // return response()->json($getBorrow, 200);
        return response()->json($data, 200);
    }

    public function showApiID($id) {
        $data = DB::table('borrow')
        ->join('assignment','assignment.assignment_id','=','borrow.assignment_id')
        ->join('return','return.borrow_id','=','borrow.borrow_id')
        ->join('asset','asset.asset_id','=','borrow.asset_id')
        ->join('location','location.location_id','=','assignment.location_id')
        // ->where('assignment.assignment_status', 1)
        ->where('borrow.borrow_id', $id)
        ->get();
        return response()->json($data, 200);
    }
}
