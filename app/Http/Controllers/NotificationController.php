<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Notification;

class NotificationController extends Controller
{
    //created in 2016/07/06 as 15:27 by Junior Oliveira
    public function all_user($id)
    {
    	# code...
    	$notification 		= Notification::where('notification_id_user', $id)->get();
    
    	return response()->json($notification);
    	//return response()->json([$notification]);
    }
     public function sum_notif($id)
    {
    	# code...
     	$tot_notification 	= Notification::where('notification_read', 0)->where('notification_id_user' , $id)->count();
  		
    	//dd($total);
    	return response()->json(['sum'=>$tot_notification]);
    	//return response()->json([$notification]);
    }

    public function update_read($id)
    {
    	//created in 2016/07/06 as 18:11 by Junior Oliveira
    	$read = Notification::where('notification_id', $id)
            	->update(['notification_read' => 1]);

        return response()->json(['mensagem'=>'success']);    	
    }
}
