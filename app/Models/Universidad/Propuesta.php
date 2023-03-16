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
        return $this->hasOne(Persona::class, 'id');
    }
    //----------------------------------------------------------------------------------
    public function documento()
    {
        return $this->belongsTo(Propuesta::class, 'id');
    }

}

