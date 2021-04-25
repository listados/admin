<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class FilesAmbience extends Model
{
    //
    protected $primaryKey = 'files_ambience_id';
	protected $table = 'files_ambience';

	protected $fillable = [
		'files_ambience_description_file' , 'files_ambience_id_ambience' , 'files_ambience_id_survey'
	];
}
