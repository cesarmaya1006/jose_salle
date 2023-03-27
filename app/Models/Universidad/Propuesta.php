<?php

namespace App\Models\Universidad;

use App\Models\Personas\Persona;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Propuesta extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'propuestas';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function emprendedor()
    {
        return $this->hasOne(Persona::class, 'id','personas_id');
    }
    //----------------------------------------------------------------------------------
    public function documento()
    {
        return $this->belongsTo(Propuesta::class, 'id');
    }
    //----------------------------------------------------------------------------------
    public function jurados()
    {
        return $this->belongsToMany(Persona::class, 'propuesta_jurados');
    }
    //----------------------------------------------------------------------------------
    public function componentesFaseUno()
    {
        return $this->hasMany(PrimFaseComponente::class, 'propuestas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function componentesFaseDos()
    {
        return $this->hasMany(SegFaseComponente::class, 'propuestas_id', 'id');
    }
    //----------------------------------------------------------------------------------

}

