<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'point_reward',
        'start_at',
        'end_at',
        'is_active',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function submissions()
    {
        return $this->hasMany(EventSubmission::class);
    }

    public function isActive(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();
        return $now->between($this->start_at, $this->end_at);
    }

    public function isExpired(): bool
    {
        return now()->isAfter($this->end_at);
    }

    public function getRemainingTimeAttribute()
    {
        if ($this->isExpired()) {
            return null;
        }

        return now()->diff($this->end_at);
    }
}
