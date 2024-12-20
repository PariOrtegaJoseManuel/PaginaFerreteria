<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;
    protected $table = 'entregas';
    protected $guarded = ['id'];
    public function relEncargo(){
        return $this->belongsTo(Encargo::class,'encargos_id','id');
    }
    public function relVenta(){
        return $this->belongsTo(Venta::class,'ventas_id','id');
    }
    public function relMetodoPago(){
        return $this->belongsTo(MetodoPago::class,'metodo_pagos_id','id');
    }
}
