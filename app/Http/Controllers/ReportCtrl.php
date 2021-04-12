<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportCtrl extends Controller
{
    public function show() {
        $data = DB::table('borrow')
        ->join('assignment','assignment.assignment_id','=','borrow.assignment_id')
        ->join('users','users.id','=','borrow.user_id')
        ->join('asset','asset.asset_id','=','borrow.asset_id')
        ->join('location','location.location_id','=','assignment.location_id')
        ->join('return','return.borrow_id','=','borrow.borrow_id')
        ->get();
        return view('pages.report.view', compact('data'));
        // return response()->json($data, 200);
    }
}
