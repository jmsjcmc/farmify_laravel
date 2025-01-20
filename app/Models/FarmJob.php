<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'farm_owner_id',
        'title',
        'job_type',
        'description',
        'requirements',
        'responsibilities',
        'salary_from',
        'salary_to',
        'salary_type',
        'vacancies',
        'employment_type',
        'start_date',
        'end_date',
        'location',
        'benefits',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'salary_from' => 'decimal:2',
        'salary_to' => 'decimal:2'
    ];

    public function farmOwner()
    {
        return $this->belongsTo(FarmOwner::class);
    }

    public function applications()
    {
        return $this->hasMany(FarmJobApplication::class);
    }

    public function skills()
    {
        return $this->hasMany(FarmJobSkill::class);
    }
}
