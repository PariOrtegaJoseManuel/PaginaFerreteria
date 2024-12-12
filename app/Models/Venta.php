<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    protected $guarded = ['id'];
    public function relDetalle(){
        return $this->hasMany(Detalle::class,'ventas_id','id');
    }
    public function relCliente(){
        return $this->belongsTo(Cliente::class,'clientes_id','id');
    }
    public function relUser(){
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function relEncargo(){
        return $this->belongsTo(Encargo::class,'encargos_id','id');
    }
    public function relEntregas(){
        return $this->hasMany(Entrega::class,'ventas_id','id');
    }
}
