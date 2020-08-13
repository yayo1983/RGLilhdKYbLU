<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
    protected $table = 'cards';

    protected $fillable = ['id','name_card_holder', 'last_name_card_holder', 'card_number','cvt','expiration_month','expiration_year'];
}
