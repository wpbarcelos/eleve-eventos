<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EventDateSubscribe extends Model
{
    use HasFactory;

    public  $guarded = [];

    public function subscribe(): BelongsTo
    {
        return $this->belongsTo(EventSubscribe::class, 'event_subscribe_id');
    }
    public function eventdate(): BelongsTo
    {
        return $this->belongsTo(EventDate::class,'event_date_id');
    }
}
