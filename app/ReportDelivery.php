<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;
use DB;

class ReportDelivery extends Model
{
    //
    protected $table = "report_deliveries";
    protected $primaryKey = 'report_deliveries_id';
    protected $fillable = ['report_deliveries_id_user' , 'report_deliveries_value' , 'report_deliveries_id_delivery' , 'report_deliveries_id_client' , 'report_deliveries_code_immobile'];

    //FUNÇÃO PASSAR O VALOR TOTAL PARA RECEBER POR DESPACHANTE
    static public function getTotalValue($id)
    {
    	$value_delivery = DB::table('deliveries')
            ->join('report_deliveries',  function ($join) use ($id){
                 $join->on('deliveries.deliveries_id', '=', 'report_deliveries.report_deliveries_id_delivery')
                 ->where('report_deliveries.report_deliveries_id_delivery' , '=', $id);
            })->sum('report_deliveries.report_deliveries_value');

        return 'R$ ' . number_format($value_delivery, 2, ',', '.'); 
    }
}
