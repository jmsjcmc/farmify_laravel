<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmCertification extends Model
{
    use HasFactory;

    protected $fillable = [
      'farm_owner_id',
        'certification_type',
        'certification_number',
        'certification_image',
        'issue_date',
        'expiry_date'
    ];

    protected $dates = [
        'issue_date',
        'expiry_date'
    ];

    public function farmOwner()
    {
        return $this->belongsTo(FarmOwner::class);
    }
}
