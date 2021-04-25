<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;
use AdminEspindola\FilesAmbience;
use AdminEspindola\Http\Requests;
use Yajra\Datatables\Datatables;
use EspindolaAdm\FilesAmbience;
use EspindolaAdm\Survey;

class FilesAmbienceController extends Controller
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
    public function update(Request $request)
    {
       
       
        try {
            //$up_am = 
            //return redirect()->back()->with('mensagem' , 'Ambiente alterado com sucesso');
            foreach ($request['files_ambience_id'] as $value) {
                FilesAmbience::where('files_ambience_id' , $value)->update(['files_ambience_id_ambience' => $request['ambience_id']]);
            }
            $data['title']          = 'Sucesso';
            $data['text']           = 'Ambiente alterado com sucesso';
            $data['styling']        = 'fontawesome';       
            $data['type']           = 'success';
            $data['icon']           = 'true';
            $data['animation']      = 'fade';
            $data['delay']          = 5000;
            $data['animate_speed']  = "slow";
            return response()->json( $data );
        } catch (Exception $e) {
            return redirect()->back()->with('error_message' , 'Ocorreu um erro, tente novamente. - '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        // $id_image = base64_decode($id);
     
        // if($type == '360'){
    
        //     $file_destroy = FilesAmbience::find($id_image);
           
        //     $file_destroy->delete();   
        //     return redirect()->back()->with('mensagem', 'Imagem 360º EXCLUIDA com sucesso');
             
        // }elseif($type == "normal"){      
                
        //     $file_destroy = FilesAmbience::find($id_image);
        //     $file_destroy->delete();
        //     return redirect()->back()->with('mensagem', 'Imagem EXCLUIDA com sucesso');

        // }    
        $conf_delete = true;  
        if(is_array($request['surveyDelete']))
        {
            
            foreach ($request['surveyDelete'] as $value) {
                $file_destroy = FilesAmbience::find($value);                
                //verificando se existe esse arquivo no repositorio
                $is_file  = is_file(base_path('public/dist/img/upload/vistoria/'.$file_destroy->files_ambience_description_file));
                //SE EXISTIR EXCLUI O MESMO
                if($is_file)
                {
                    unlink(base_path('public/dist/img/upload/vistoria/'.$file_destroy->files_ambience_description_file));
                }    
                $file_destroy->delete();
                $conf_delete = true;
            }

        }
        if ($conf_delete) {
            $data['title']          = 'Sucesso';
            $data['text']           = 'Imagem excluída com sucesso';
            $data['styling']        = 'fontawesome';       
            $data['type']           = 'success';
            $data['icon']           = 'true';
            $data['animation']      = 'fade';
            $data['delay']          = 5000;
            $data['animate_speed']  = "slow";
            return response()->json( $data );
        }
    }


    public function deleteFiles(Request $request)
    {
        if(is_array($request['surveyDelete']))
        {
            echo "é array!";
            foreach ($request['surveyDelete'] as $value) {
                echo "Valores: ".$value.', ';
            }

        }

        //  if(is_array($request['surveyAlter']))
        // {
        //     echo "é para alterar!";
        //     foreach ($request['surveyAlter'] as $value) {
        //         echo "Valores: ".$value.', ';
        //     }

        // }
        
    }

    public function all_image(Request $request)
    {
        // $input = $request->except('_token');
        // foreach ($input as  $value) {
        //     foreach ($value as $key) {
        //         //echo $key."<br/>";
        //         Files::where('files_id', $key)->delete();
               
        //     }
        // }
        // return redirect()->back()->with('mensagem' , 'Arquivos excluído com sucesso');
        dd($request->all());
    }
}
