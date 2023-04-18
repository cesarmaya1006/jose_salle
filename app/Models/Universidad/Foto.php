<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Foto extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'fotos';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function componenteFaseUno()
    {
        return $this->belongsTo(PrimFaseComponente::class, 'prim_fase_componente_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
