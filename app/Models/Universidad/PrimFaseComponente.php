<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PrimFaseComponente extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'prim_fase_componentes';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class, 'propuestas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function notas()
    {
        return $this->hasMany(PrimFaseNota::class, 'prim_fase_componentes_id', 'id');
    }
}
