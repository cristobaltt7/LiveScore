<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    use HasFactory;

    // Define los campos que se pueden asignar
    protected $fillable = [
        'team_id',
        'name',
        'position',
        'number',
        'photo',
    ];
}
