<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    //create 2017-09-09 by Excellence Soft
    protected $primaryKey = "deliveries_id";

    protected $fillable = ['deliveries_name' , 'deliveries_phone' , 'deliveries_mobile' , 'deliveries_value' , 'deliveries_cpf'];

    static public function getSumValueDelivery($year, $month, $id_delivery)
    {
    	$delivery   = DB::table('report_deliveries')->whereYear('report_deliveries.created_at', '=', $year)
                        ->whereMonth('report_deliveries.created_at', '=', $month)
                        ->where('report_deliveries_id_delivery' , $id_delivery )
                        ->sum('report_deliveries_value');
        return $delivery;                
    }
}
