<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;
    protected $table = 'metodo_pagos';
    protected $guarded = ['id'];
    public function relEntregas(){
        return $this->hasMany(Entrega::class,'metodo_pagos_id','id');
    }
    public function relDetalle(){
        return $this->hasMany(Detalle::class,'metodo_pagos_id','id');
    }
}

