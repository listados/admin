<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Image, DB;
use Carbon\Carbon;
use AdminEspindola\Files;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }

     /**
     * upload de arquivos variados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function upload(Request $request, $id, $tipo)
     {
         if($request->ajax())
         {

        
          //dd($_FILES['kartik-input-700']['name']);
        try {
              
             $tot_array = count($_FILES["new_files"]["name"]);
            
            for ($i=0; $i < $tot_array; $i++) { 

                $tmp_name = $_FILES["new_files"]["tmp_name"][$i];
               
                // //PEGANDO A EXTENSAO DA CADA IMAGEM                
                $exp = explode(".", $_FILES["new_files"]["name"][$i]);
                $extension = end($exp);
                // // //RENOMIANDO O ARQUIVO
                $name =  time(). '_'.Str::random(20).'.'.$extension;

                $directory = dirname(dirname(dirname(dirname(dirname(__DIR__))))).'\\escolhaazul\\public\\img\\upload\\';
                $novo_dir  = str_replace('\\', '/', $directory);
                
                /*   
                    SWITH PARA VERIFICAR A EXTENSAO DO ARQUIVO - 
                    SUPORTE PARA ['jpg', 'gif', 'png', 'txt', 'doc' , 'docx' , 'xls' , 'pdf' , 'xlsx']  
                */           
                switch ($extension) {
                        case 'jpg':
                           Image::make($tmp_name)->resize(300,300)->save($novo_dir . $name);
                           break;
                        case 'gif':
                           Image::make($tmp_name)->resize(300,300)->save($novo_dir . $name);
                           break;
                        case 'png':
                           Image::make($tmp_name)->resize(300,300)->save($novo_dir . $name);
                           break;
                        case 'txt':
                           move_uploaded_file($tmp_name, $novo_dir . $name);
                           break;
                        case 'doc':
                            move_uploaded_file($tmp_name, $novo_dir . $name);
                           break;
                        case 'docx':
                            move_uploaded_file($tmp_name, $novo_dir . $name);
                           break;
                        case 'xls':
                           move_uploaded_file($tmp_name, $novo_dir . $name);
                           break;
                        case 'pdf':
                            move_uploaded_file($tmp_name, $novo_dir . $name);
                           break;
                        case 'xlsx':
                            move_uploaded_file($tmp_name, $novo_dir . $name);
                           break;
                        
                   }   

                //Image::make($tmp_name)->resize(300,300)->save($novo_dir . $name);
                //CADASTRANDO NO BANCO
                switch ($tipo) {
            case 'proposta-pf':
                $profile = 'Inquilino';
                $table = 'proposal';
                $campo = 'proposal_id';
                $abr_profile = 'pf';
                break;
            case 'proposta-pj':
                $profile = 'Juridico';
                $table = 'legal';
                $campo = 'legal_id';
                $abr_profile = 'pj';
                break;
            case 'cadastro-pf':
                $profile = 'Fiador';
                $table = 'guarantor';
                $campo = 'guarantor_id';
                $abr_profile = 'pf';
                break;
            case 'cadastro-pj':
                $profile = 'Fiador Juridico';
                $table = 'guarantor_legal';
                $campo = 'guarantor_legal_id';
                $abr_profile = 'pj';
                break;  
            default:
                $profile = 'Inquilino';
                $table = 'proposal';
                $campo = 'proposal_id';
                $abr_profile = 'pf';
                break;

        }

                $files_ambience =   DB::table('files')->insert([
                    
                    'files_name' => $name ,
                    'files_id_proposal' => $id ,
                    'files_date' => Carbon::now() ,
                    'files_profile' => $profile,
                    'files_type' => "Upload Avulso"  
                    
                ]); 

               
            }          
            //notificando a todos os usuarios
            // Helpers::reg_not_all(null, Auth::user()->nick. " adicionou novas imagens na vistoria ".$id_survey);              
             return response()->json(['mensagem' => 'success']);


          } catch (Intervention\Image\Exception\NotReadableException $e) {

               return response()->json(['error' => $e->getMessage()]);

          }

         }
     }

     public function delete_files(Request $request)
     {
        # created 2017-09-02 by Excellence Soft
        // $del = $request->all();
        dd($request->all());
        $input = $request->except('_token');
        foreach ($input as  $value) {
            foreach ($value as $key) {
                //echo $key."<br/>";
                Files::where('files_id', $key)->delete();
               
            }
        }
        return redirect()->back()->with('mensagem' , 'Arquivos excluído com sucesso');
     }
}
