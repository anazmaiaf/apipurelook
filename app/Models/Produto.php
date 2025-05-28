<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $casts = [
        'preco' => 'float',
    ];

    protected $fillable = [
        'nome',
        'preco',
        'quantidade',
        'marca'
    ];
}
