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
    //----------------------------------------------------------------------------------
    public function subcomponente()
    {
        return $this->belongsTo(SubComponente::class, 'sub_componente_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function notas()
    {
        return $this->hasMany(PrimFaseNota::class, 'prim_fase_componentes_id', 'id');
    }
     //----------------------------------------------------------------------------------
     public function documentos()
     {
         return $this->hasMany(Documento::class, 'prim_fase_componente_id', 'id');
     }
     //----------------------------------------------------------------------------------
      //----------------------------------------------------------------------------------
    public function fotos()
    {
        return $this->hasMany(Foto::class, 'prim_fase_componente_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
