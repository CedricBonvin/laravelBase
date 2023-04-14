<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_REFUSED = 1;
    const STATUS_MODIFICATION = 2;
    const STATUS_ACCEPTED = 3;
    CONST STATUS_DELETED = 4;

    protected $fillable = [
        'name',
        'slug',
        'alias',
        'status',
        'min_players',
        'max_players',
        'duration',
        'goal',
        'setup',
        'gameplay',
        'end',
    ];

    protected $casts = [
        'alias' => 'array',
    ];
    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'game_equipment', 'game_id', 'equipment_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'game_category', 'game_id', 'category_id');
    }

    public function situations(): BelongsToMany
    {
        return $this->belongsToMany(Situation::class, 'game_situation', 'game_id', 'situation_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'game_user', 'game_id', 'user_id');
    }

    public function getAverageRating()
    {
        return round($this->ratings()->avg('rating'), 1);
    }

    public function getAliases(): array
    {
        return explode(',', $this->alias);
    }
}
