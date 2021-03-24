<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pais extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'pais';
    protected $guarded = [];
}