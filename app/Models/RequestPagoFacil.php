<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestPagoFacil extends Model
{
    //
    protected $table = 'requestpagofacils';

    protected $fillable = ['id','autorizado','autorizacion','transaccion','texto','error',
        'empresa','transIni','transFin','TipoTC','data','dataVal','pf_message','status'];
}
