<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'size',
        'crust',
        'toppings',
        'status'
    ];

    protected $hidden = [
        'user'
    ];

    protected $casts = [
        'toppings' => 'array'
    ];

    protected $appends = [
        'chef',
        'last_updated',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getChefAttribute(): string
    {
        return $this->user->name;
    }

    public function getLastUpdatedAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }
}
