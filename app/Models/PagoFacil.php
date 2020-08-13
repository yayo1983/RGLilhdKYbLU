<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoFacil extends Model
{
    //
    protected $table = 'pagofacils';

    protected $fillable = ['id','method','id_service'];
}
