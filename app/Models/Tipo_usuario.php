<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    public $timestamps = false;
    public $fillable = ['tipo','estado'];
}
