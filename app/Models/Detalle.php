<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    protected $table = 'detalles';
    protected $guarded = ['id'];
    public function relVenta(){
        return $this->belongsTo(Venta::class,'ventas_id','id');
    }
    public function relArticulo(){
        return $this->belongsTo(Articulo::class,'articulos_id','id');
    }
}
