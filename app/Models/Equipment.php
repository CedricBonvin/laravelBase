<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $fillable = [
        'name',
        'slug'
    ];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_equipment', 'equipment_id', 'game_id');
    }
}
