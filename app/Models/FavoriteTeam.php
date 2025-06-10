<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'football_data_id',
        'transfermarkt_id',
        'team_name',
        'team_logo'
    ];
}