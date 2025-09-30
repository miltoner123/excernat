<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable=[
        'nombre',
        'descripcion',
        'precio',
        'lote',
        'imagen',
        'fecha_vencimiento',
        'unidad_medida',
        'categoria_id',
    ];
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
