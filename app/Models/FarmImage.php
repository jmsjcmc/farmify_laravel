<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_owner_id',
        'image_path',
        'caption'
    ];

    public function farmOwner()
    {
        return $this->belongsTo(FarmOwner::class);
    }
}
