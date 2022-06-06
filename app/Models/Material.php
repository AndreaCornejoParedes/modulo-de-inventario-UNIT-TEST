<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'material';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Descripcion',
        'ID_Catalogo',
        'Unidad_de_medida',
        'Codigo_sap',
        'Cotizacion',
    ];
    
}
