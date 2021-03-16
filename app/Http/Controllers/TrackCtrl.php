<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackCtrl extends Controller
{
    public function show() {
        return view('pages.maps');
    }

    public function assignment() {
        return view('pages.assignment.view');
    }

    public function location() {
        return view('pages.location.view');
    }

    public function asset() {
        return view('pages.asset.view');
    }

    public function report() {
        return view('pages.report.view');
    }

    public function user() {
        return view('pages.user.view');
    }
}
