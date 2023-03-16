<?php

namespace App\Models\Universidad;

use App\Models\Personas\Persona;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PrimFaseNota extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'prim_fase_notas';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function componente()
    {
        return $this->belongsTo(PrimFaseComponente::class, 'prim_fase_componentes_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function jurado()
    {
        return $this->belongsTo(Persona::class, 'personas_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
