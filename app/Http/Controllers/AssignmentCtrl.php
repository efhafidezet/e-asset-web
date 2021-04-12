<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Assignment;
use App\Models\Location;

class AssignmentCtrl extends Controller
{
    public function show() {
        // $data = Assignment::where('is_active', 1)
        //        ->get();
        $data = DB::table('assignment')
        ->join('location','location.location_id','=','assignment.location_id')
        ->where('assignment.is_active', 1)
        ->get();
        $data1 = Location::where('is_active', 1)
               ->get();
        return view('pages.assignment.view', compact('data', 'data1'));
    }

    public function store(Request $request) {
        Assignment::create([
    		'assignment_name' => $request->assignment_name,
    		'assignment_date' => $request->assignment_date,
    		'assignment_details' => $request->assignment_details,
    		'location_id' => $request->location_id,
    		'radius' => $request->radius,
    		'assignment_status' => 1,
    		'is_active' => 1
    	]);
 
    	return redirect('/assignment');
    }

    public function update(Request $request) {
        Assignment::where('assignment_id', $request->assignment_id)
            ->update([
                'assignment_name' => $request->assignment_name,
                'assignment_date' => $request->assignment_date,
                'assignment_details' => $request->assignment_details,
                'location_id' => $request->location_id,
                'radius' => $request->radius,
                'assignment_status' => $request->assignment_status,
                ]);
 
    	return redirect('/assignment');
    }

    public function delete(Request $request) {
        Assignment::where('assignment_id', $request->assignment_id)
            ->update(['is_active' => 0]);
 
    	return redirect('/assignment');
    }

    public function showApi() {
        $data = DB::table('assignment')
        ->join('location','location.location_id','=','assignment.location_id')
        ->where('assignment.is_active', 1)
        ->get();
        return response()->json($data, 200);
    }

    public function showApiID($id) {
        $data = DB::table('assignment')
        ->join('location','location.location_id','=','assignment.location_id')
        ->where('assignment.is_active', 1)
        ->where('assignment.assignment_id', $id)
        ->get();
        return response()->json($data, 200);
    }
}
