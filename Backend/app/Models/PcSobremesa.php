<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcSobremesa extends Model
{

    use HasFactory;
    protected $table = 'pc_sobremesa';
    protected $fillable = [
        'producte_id',
        'gaming',
        'potencia_fuente'
    ];
}
