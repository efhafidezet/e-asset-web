<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ReturnM;
use App\Models\Assignment;
use App\Models\Asset;
use App\Models\Borrow;

class ReturnCtrl extends Controller
{
    public function store(Request $request) {
        // $data = ReturnM::create([
    	// 	'return_date' => Carbon::now()->toDateTimeString(),
    	// 	'borrow_id' => $request->borrow_id
    	// ]);

        $data = ReturnM::where('borrow_id', $request->borrow_id)->update([
            'return_date' => Carbon::now()->toDateTimeString(),
        ]);

        $getBorrow = Borrow::where('borrow_id', $request->borrow_id)
               ->get();

        Assignment::where('assignment_id', $getBorrow[0]->assignment_id)->update([
            'assignment_status' => 3,
        ]);

        Asset::where('asset_id', $getBorrow[0]->asset_id)->update([
            'status' => 1,
        ]);

        // return response()->json($getBorrow[0], 200);
        return response()->json($data, 200);
    }
}
