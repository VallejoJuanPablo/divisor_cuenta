<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    protected $fillable = ['dni','nombre','codigo','motivo','monto_total','personas'];

}
