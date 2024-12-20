<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $guarded = ['id'];
    public function relVenta(){
        return $this->hasMany(Venta::class,'clientes_id','id');
    }
    public function relEncargo(){
        return $this->hasMany(Encargo::class,'clientes_id','id');
    }
}
