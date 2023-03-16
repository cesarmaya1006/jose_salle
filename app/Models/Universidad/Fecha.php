<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Fecha extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'fechas';
    protected $guarded = [];
}
