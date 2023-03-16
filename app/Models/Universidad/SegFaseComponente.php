<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SegFaseComponente extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'seg_fase_componentes';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class, 'propuestas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function notas()
    {
        return $this->hasMany(SegFaseNota::class, 'seg_fase_componentes_id', 'id');
    }
}
