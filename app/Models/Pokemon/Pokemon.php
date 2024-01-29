<?php

namespace App\Models\Pokemon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokemon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pokemons';
    protected $fillable = ['id', 'name', 'code', 'category', 'main_ability', 'icon_link'];

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function getStatus()
    {
        return $this->hasOne(Status::class)->get()->first();
    }
}
