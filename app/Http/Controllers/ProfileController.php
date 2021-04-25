<?php
namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Perfil;
use AdminEspindola\Http\Controllers\Auth;
use AdminEspindola\User;
use DB;


class ProfileController extends Controller
{
    //CRIADO EM 05/07/2016 AS 18:42
    public function cadastre(Request $request){
    	if($request->ajax()){

    		$perfil = Perfil::create($request->all());
    		
    		
    		return response()->json(['mensagem' => "Sucesso: ".$request['profile_name']]);
    		
    	}
    }

    public function edit_profile($id, Request $request)
    {
        //CRIADO EM 05/07/2016 AS 22:04

       // $id_profile = Profile::find($id);
    $id_user = Auth::user()->id;
      
    $edit_profile = User::where('user_id' ,  $id_user)->update(['id_profile' => $id]);

        if($edit_profile){
            return response()->json(['mensagem'=> 'success']);
        }

    }

    public function all_profile(Request $request)
    {
        //CRIADO EM 08/07/2016 as 17:37 by Junior Oliveira
        $profile = Perfil::all();

        $profile_present = DB::table('profile')
                        ->join('settings' , 'profile.profile_id' , '=', 'settings.settings_id_profile' )
                        ->get();
        
        return view('profile.edit_profile_proposal', compact('profile','profile_present' ));

    }

    public function edit_profile_proposal(Request $request)
    {
        # CRIADO EM 08/07/2016 AS 19:25
        if($request->ajax()){

            DB::table('settings')->where('settings_description','edit_profile_proposal')->update(['settings_id_profile' => $request['settings_id_profile']]);

            return response()->json(['mensagem' => 'success']);

        }
    }

}
