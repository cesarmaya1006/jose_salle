<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Documento extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'documentos';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function propuesta()
    {
        return $this->hasOne(Propuesta::class, 'id');
    }
    //----------------------------------------------------------------------------------
}
