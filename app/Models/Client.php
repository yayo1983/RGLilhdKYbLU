<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $table = 'clients';

    protected $fillable = ['id','cp','email', 'telephone','cellular','streetnumber','suburb','municipality','state','country'];
}
