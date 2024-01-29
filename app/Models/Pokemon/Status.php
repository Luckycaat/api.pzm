<?php

namespace App\Models\Pokemon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'pokemon_status';
    protected $fillable = ['id', 'hp', 'attack', 'defense', 'speed', 'pokemon_id'];
}
