<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    //
    protected $table = 'establishments';

    protected $fillable = ['id', 'amount_mxp','id_user_company','id_branch_office','param1','param2','param3','param4','param5',
        'plan','monthly_payments','http_user_agent','ip_server'];
}
