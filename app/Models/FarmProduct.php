<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'farm_owner_id',
        'product_name',
        'product_type',
        'description',
        'price',
        'unit',
        'available_quantity',
        'product_image',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean'
    ];

    public function farmOwner()
    {
        return $this->belongsTo(FarmOwner::class);
    }
}
