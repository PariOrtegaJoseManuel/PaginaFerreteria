<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $table = 'articulos';
    protected $guarded = ['id'];
    public function relDetalle(){
        return $this->hasMany(Detalle::class,'articulos_id','id');
    }
    public function relUnidad(){
        return $this->belongsTo(Unidad::class,'unidades_id','id');
    }
    public function relCategoria(){
        return $this->belongsTo(Categoria::class,'categorias_id','id');
    }
}
