<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reunion_gasto extends Model
{
    protected $fillable = ['id_reunion','codigo','dni','nombre','monto','descripcion','estado'];
}
