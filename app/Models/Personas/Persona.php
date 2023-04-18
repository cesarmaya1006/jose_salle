<?php

namespace App\Models\Personas;

use App\Models\Admin\Tipo_Docu;
use App\Models\Admin\Usuario;
use App\Models\Universidad\PrimFaseNota;
use App\Models\Universidad\Propuesta;
use App\Models\Universidad\SegFaseNota;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Persona extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'personas';
    protected $guarded = [];

    public function tipos_docu()
    {
        return $this->belongsTo(Tipo_Docu::class, 'docutipos_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id');
    }
    //----------------------------------------------------------------------------------
    //relationships One to One
    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class, 'id','personas_id');
    }
    //----------------------------------------------------------------------------------
    public function notas_uno()
    {
        return $this->hasMany(PrimFaseNota::class, 'personas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function notas_dos()
    {
        return $this->hasMany(SegFaseNota::class, 'personas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function propuestas_j()
    {
        return $this->belongsToMany(Propuesta::class, 'propuesta_jurados','persona_id','propuesta_id');
    }
    //----------------------------------------------------------------------------------
}
