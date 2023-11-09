<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventDate extends Model
{
    use HasFactory;

    public  $guarded = [];

    public $casts =['date'=>'date'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function datesubscribes(): HasMany
    {
        return $this->hasMany(EventDateSubscribe::class);
    }

    public function subscribes(): BelongsToMany
    {
        return $this->belongsToMany(EventSubscribe::class, 'event_date_subscribes', 'event_date_id', 'event_subscribe_id')
            ->withPivot('present');
    }
}
