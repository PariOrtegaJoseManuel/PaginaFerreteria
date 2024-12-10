<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    protected $table = 'unidades';
    protected $guarded = ['id'];
    public function relArticulo(){
        return $this->hasMany(Articulo::class,'unidades_id','id');
    }
}
