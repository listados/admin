<?php
namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\User;
use AdminEspindola\Password_resets;
use AdminEspindola\Helpers;
use Crypt;
use Session, Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;
use DB, PDF, Validator;
use AdminEspindola\Perfil;
use AdminEspindola\Survey;
use AdminEspindola\Http\Requests\UserRequest;
use Mail;

class UserController extends Controller
{
   public function __construct()
   {
      if(Auth::check())
      {
        $this->middleware('auth');
      }else{
        return redirect('login');
      }
   }

   public function all()
   {
     
      $user = DB::table('profile')
                        ->join('users' , 'profile.profile_id' , '=', 'users.id_profile' )
                        //->where('receive_proposal' , '=' , 1)
                        ->get();

      $profile       = Perfil::all();  
      $total_user    = User::count(); 
      $user_active   = User::where('status', 1)->count(); 

      if(Auth::user()->adm == 1){
         return view('profile.manager_user', compact('user', 'profile', 'total_user' , 'user_active')); 
      }else{
         // Session::flash('mensagem', 'Você não tem permissão para acessar essa página, entre em contato com o administrador para ver o que ele pode lhe ajudar.');
         // return view('505');
        // abort(403);
        return "erro";

      }
     
   }

   public function add_user()
   {
      $profile       = Perfil::all();  
     return view('profile.add_user', compact('profile'));
   }

   //CRIADO EM 10/07 BT JUNIOR OLIVEIRA
   public function add_user_create(UserRequest $request)
   {
      if($request->hasFile('avatar')){
         
         $avatar     = $request->file('avatar');
         $filename   = time(). '.'. $avatar->getClientOriginalExtension();
         Image::make($avatar)->resize(300,300)->save('public/dist/img/upload/profile/'. $filename);        
        
      }

      $request['avatar'] = 'user-default-avatar.jpg';
      
      //REGISTRANDO USUÁRIO
      $request['cpf'] = $request->cpf;

      User::create($request->all());
      //RECEBENDO TODOS USUÁRIOS
      $user = User::all();
      //PEGANDO ULTIMO USUÁRIO
      $user_last = $user->last();
      //NOTIFICANDO OS USUARIOS
      $description = Auth::user()->nick." adicionou ".$user_last->nick." como usuário(a) do sistema"; 
      Helpers::reg_not_all($user = null, $description);


      //RECEBENDO RETORNO DO ENVIO DE EMAIL
      $email_user = Mail::send('emails.convite', ['user_last' => $user_last], function ($m) use ($user_last) {
          
         $m->to($user_last->email, $user_last->name)->subject('Acesso ao Sistema Admin Espindola');

      });

     if($email_user)
     {
       return redirect('configuracao/usuarios')->with('mensagem', 'Usuário cadastrado com sucesso');

     }else{
      return "Erro";
     }
   

   }

   public function search_user($id, Request $request)
   {
   	# code...
   	$user = User::find($id);

   	//return $user;
   	return view('profile.user', compact('user'));
   }

   public function update(UserRequest $request)
   {
      $user_adm = Auth::user()->adm;

   	$user = User::find($request['id']);

      //SE VINHAR DADOS NO ARRAY ENTAO CRIPTOGRAFA, CASO NÃO.... EXCLUIR A POSIÇÃO DO ARRAY
   	if(!empty($request['password'])){
   		$user->password = bcrypt($request['password']);
   	}else{
         unset($request['password']);
      }

 	   if($user->status == 1){
         $user->status = 1;
      }else{
         $user->status = 0;
      } 
     
   	$user->name 	   = $request['name'];
   	$user->email 	   = $request['email'];
    $user->cpf       = $request['cpf'];
      $user->id_profile = $request['id_profile'];
   	
   	if($user->save()){
         //MUDANDO A ROTA DE ACORDO COM O STATUS DE QUEM ESTÁ LOGADO E DE QUEM ENVIOU
   		if($user_adm == 1){
          
         return redirect('configuracao/usuarios')->with('mensagem','Usuário alterado com sucesso');
           
         }else{
            return redirect('admin/usuario/'.$user->id)->with('mensagem','Usuário alterado com sucesso');
           
         }
   	}else{

   	}
   }

   public function destroy($id)
   {
      $user_adm = Auth::user()->adm;
      $user = User::find($id);
      $delete_user = User::destroy($id);
   
      try {
         //NOTIFICANDO OS USUARIOS
        $description = Auth::user()->nick." excluiu ".$user->nick." como usuário(a) do sistema"; 
        Helpers::reg_not_all($user = null, $description);
        return Redirect::to('/usuario-excluido');


      } catch (Exception $e) {
         Session::flash('mensagem', 'Erro ao tentar excluir registro: '.$e);
         return view('profile.user' , compact('user'));
      }
   }

   public function update_avatar(Request $request)
   {
      #ALTERANDO O AVATAR DO USUÁRIO - USANDO UM PLUGIN
      if($request->hasFile('avatar')){
         $id_user    = Auth::user()->id;
         $avatar     = $request->file('avatar');
         $filename   = time(). '.'. $avatar->getClientOriginalExtension();
         Image::make($avatar)->resize(300,300)->save('dist/img/upload/profile/'. $filename);

         DB::table('users')->where('id', $id_user)->update(['avatar' => $filename]);  
      }
       return Redirect::to('/admin/usuario/'.$id_user)->withMessage('Usuário excluido com sucesso');
   
   }

   public function pdf_users()
   {
      # desenv 06/07/2016 11:32 Junior Oliveira
      $users = DB::table('profile')
                        ->join('users' , 'profile.profile_id' , '=', 'users.id_profile' )
                        ->get();
    
       $pdf = PDF::loadView('profile.pdf-users',['users' => $users]); 
       $pdf->setPaper('A4', 'landscape');  
       return $pdf->stream(); 
     
   }

   public function find_user($id){

      $user = DB::table('profile')
                        ->where('users.id','=', $id)                         
                        ->join('users' , 'profile.profile_id' , '=', 'users.id_profile' )
                        ->get();

      $profile = Perfil::all();    

      return view('profile.edit_user', compact('user', 'profile', 'id'));     
   }

   public function update_user(Request $request)
   {
      # CRIADO EM 09/07/2016 AS 19:27 By Junior Oliveira
      $user = DB::table('users')->where('id',$request['id']);

      $input = $request->except('_token');

      DB::table('users')
            ->where('id', $request['id'])
            ->update($input);

      return redirect('configuracao/usuarios')->with('mensagem' , 'Usuário ALTERADO com sucesso');
    
    
   }

  

   public function reset_password(Request $request)
   {
      # 10/07/2016  as 17:19 by Junior Oliveira
      $senha =  Hash::make($request['password']);

      $user = User::find($request['id']);

      $edit_password = DB::table('users')->where('id' , $request['id'])->update(['password' => $senha] );
      $token         = DB::table('password_resets')->where('email' , $user->email);
     
      $token->delete();
      $reset_token = Str::random(60);
      
      $new_token = DB::table('password_resets')->insert([
          'email' => $user->email,
          'token' => $reset_token,
         
      ]);
      
     return redirect(url('/login'));
   }

   public function reset_password_adm(Request $request)
   {
      # envio será enviado para usuario atravez do administrador
      $user = User::find($request['id']);
      //dd($user);
      Mail::send('emails.convite', ['user' => $user], function ($m) use ($user) {
           
            $m->to($user->email, $user->name)->subject('Acesso ao Sistema Admin Espindola');
      });

      return redirect()->back()->withMessage('mensagem', 'Enviado link para o email do usuário');
   }

   public function showResetPassword(Request $request)
   {
      $user = User::find($request['id']);
      $token = Str::random(60);
      $callback = null;

      $email =  Mail::send('auth.emails.password', compact('token', 'user'), function ($m) use ($user, $token, $callback) {
            $m->to($user->email)->subject('Your Password Reset Link');           
        });

        if($email){
             return redirect()->back()->with('mensagem','E-mail enviado com o link para o usuário');
        } 
   }

   public function email_teste()
   {
      # code...
       //$survey = Survey::find(128);
       //$attach = url('public/dist/img/upload/vistoria/1470944792_21190922394037.jpg');
    $user = Auth::user();
    $data = "Teste de envio";

       $email = Mail::send('emails.email_teste', [$data => "Teste de envio" ], function ($m) {
               
         $m->to('franciscoanto@gmail.com','Junior')->subject('Vistoria 360 - Novo upload 360');
         //$m->attach($attach);
          
       });

       if($email){
       
          echo "Enviador";
       
       }else{
          
          echo "false";
       
       }
      
   }

  

}
