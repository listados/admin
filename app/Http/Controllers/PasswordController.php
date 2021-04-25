<?php
//CREATE 18/07/2016 AS 23:00 BY JUNIOR OLIVEIRA
namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\User;
use DB;


class PasswordController extends Controller
{
    //CREATE 18/07/2016 AS 23:08 BY JUNIOR OLIVEIRA
     public function cad_password($id)
   {
      # code...
      $user = User::find($id);
      return view('profile.reset_password',compact('user'));
   }


    public function create(Request $request)
    {
    	# code...
    	$user = User::find($request['id']);

    	$user->password = bcrypt($request['password']);

    	if($user->save()){
    		return redirect('login');
    	}else{
    		return redirect()->back()->withErrors();
    	}
    }
}
