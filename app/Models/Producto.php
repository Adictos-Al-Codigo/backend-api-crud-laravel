<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps = false;
    public $fillable = ['nombre_producto','cantidad','estado','foto_producto','id_marcas','id_categorias','id_proveedors'];
}
