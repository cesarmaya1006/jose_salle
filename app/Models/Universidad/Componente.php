<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Componente extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'componentes';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function sub_componentes()
    {
        return $this->hasMany(SubComponente::class, 'componente_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
