<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['id', 'id_establishment','id_card','id_client','id_pago_facil'];
}
