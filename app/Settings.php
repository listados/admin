<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';

    protected $primaryKey = 'settings_id';

    protected $fillable = ['settings_date_last_sync' , 'settings_total_immobile_sync' , 'settings_id_user_sync'];
}
