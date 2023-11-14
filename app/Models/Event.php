<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'date_start',
        'date_end',
        'subscribe_start',
        'subscribe_until',
        'limit_subscribe',
    ];

    public function subscribes():HasMany
    {
        return $this->hasMany(EventSubscribe::class);
    }

    public function dates():HasMany
    {
        return $this->hasMany(EventDate::class);
    }

    public function eventSubscribes():HasMany
    {
        return $this->hasMany(EventSubscribe::class);
    }
}
