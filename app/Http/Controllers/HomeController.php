<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Location;
use App\Models\Asset;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataLoc = Location::where('is_active', 1)
            ->get();
        $dataAsset = Asset::where('is_active', 1)
            ->get();
        $dataAssignment = Assignment::where('is_active', 1)
            ->orderBy('assignment_date', 'DESC')
            // ->limit(5)
            ->get();
        $dataAssignmentDone = Assignment::where('is_active', 1)
            ->where('assignment_status', 1)
            ->orderBy('assignment_date', 'DESC')
            ->get();
        $dataAssignmentRunning = Assignment::where('is_active', 1)
            ->where('assignment_status', 2)
            ->orderBy('assignment_date', 'DESC')
            ->limit(10)
            ->get();
        return view('home', compact('dataLoc','dataAsset','dataAssignment','dataAssignmentDone','dataAssignmentRunning',));
        // return view('home');
    }
}
