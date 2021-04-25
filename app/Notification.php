<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    ////created in 2016/07/06 as 15:31 by Junior Oliveira
    protected $table = 'notification';
    protected $primaryKey = 'notification_id';
    protected $fillabel = [
    	'notification_description', 'notification_read' , 'notification_id_user'
    ];

}
