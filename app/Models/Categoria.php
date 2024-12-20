<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $guarded = ['id'];
    public function relArticulo(){
        return $this->hasMany(Articulo::class,'categorias_id','id');
    }
}
