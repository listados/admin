<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;

class PainelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


   public function index()
   {
   	# code...
   	return view('home');
   }
}
