<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Borrow;
use App\Models\Assignment;
use App\Models\Asset;
use App\Models\ReturnM;

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
            'borrow_id'=> $getBorrow[0]->borrow_id
        ]);

        Assignment::where('assignment_id', $request->assignment_id)->update([
                'assignment_status' => 2,
            ]);

        Asset::where('asset_id', $request->asset_id)->update([
                'status' => 0,
            ]);

        // return response()->json($getBorrow, 200);
        return response()->json($data, 200);
    }
}
