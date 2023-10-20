<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSubscribe extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }


    public function congregation(): BelongsTo
    {
        return  $this->belongsTo(Congregation::class);
    }

    public function role(): BelongsTo
    {
        return  $this->belongsTo(Role::class);
    }
}
