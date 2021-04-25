<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;
use AdminEspindola\Survey;
use AdminEspindola\User;
use Mail;
use DB, PDF, Validator;

use AdminEspindola\Http\Requests;

//Created in 2016-07-29 10:26 by Junior Oliveira
class PdfViewController extends Controller
{
    //
    public function view_survey($id)
    {

        $id_dec = base64_decode($id);
    	# //Created in 2016-07-29 10:32 by Junior Oliveira
    	$survey = Survey::find($id_dec);
    	 //return view('survey.report.view_survey' , compact('survey'));
        $pdf = PDF::loadView('survey.report.view_survey',['survey' => $survey ]); 
        $pdf->setPaper('A4', 'report');  
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        /*page_text(pos_horizontal,pos_vertical , texto , null , tamanho, cor_em_rgb)
        */
        $canvas->page_text(530, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream();
    }





}
