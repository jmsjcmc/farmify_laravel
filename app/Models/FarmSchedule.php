<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_owner_id',
        'activity_type',
        'description',
        'start_time',
        'end_time',
        'is_recurring',
        'recurrence_pattern'
    ];

    protected $dates = [
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'is_recurring' => 'boolean'
    ];

    public function farmOwner()
    {
        return $this->belongsTo(FarmOwner::class);
    }
}
