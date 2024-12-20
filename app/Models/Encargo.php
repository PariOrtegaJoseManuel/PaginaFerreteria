<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargo extends Model
{
    use HasFactory;
    protected $table = 'encargos';
    protected $guarded = ['id'];
    public function relCliente(){
        return $this->belongsTo(Cliente::class,'clientes_id','id');
    }

    public function relEntregas(){
        return $this->hasMany(Entrega::class,'encargos_id','id');
    }
}
