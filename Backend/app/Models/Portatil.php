<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portatil extends Model
{
    use HasFactory;
    protected $table = 'portatiles';
    protected $fillable = [
        'producte_id',
        'capacidad_bateria',
        'amperaje_cargador'
    ];
}
