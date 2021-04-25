<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use AdminEspindola\Http\Requests;

class TourVirtualController extends Controller
{
    //
    public function index()
    {
    	# code...
    	$tour = DB::table('tour')->get();
    	return view('tour.index' , compact('tour'));
    }
}
