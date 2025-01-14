<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmOwner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'farm_name',
        'farm_address',
        'farm_size',
        'farm_type',
        'contact_number',
        'farm_description',
        'business_permit_number',
        'business_permit_image',
        'valid_id_type',
        'valid_id_number',
        'valid_id_image',
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by'
    ];

    protected $dates = [
        'approved_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function images()
    {

    }

    public function certifications()
    {

    }

    public function products()
    {

    }

    public function schedules()
    {

    }

    public function facilities()
    {
        
    }
}
