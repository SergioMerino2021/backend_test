<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'codigo_producto',
        'activo',
        'fecha_entrada'
    ];
    public function pcSobremesa()
    {
        return $this->hasOne(PcSobremesa::class, 'producte_id');
    }

    public function portatil()
    {
        return $this->hasOne(Portatil::class, 'producte_id');
    }
}
