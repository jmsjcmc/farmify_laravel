<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmJobApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'farm_job_id',
        'user_id',
        'cover_letter',
        'resume_path',
        'status',
        'notes',
        'interview_date',
        'offered_salary',
        'offered_salary_type',
        'hiring_date',
        'rejection_reason'
    ];

    protected $casts = [
        'interview_date' => 'datetime',
        'hiring_date' => 'datetime',
        'offered_salary' => 'decimal:2'
    ];

    public function job()
    {
        return $this->belongsTo(FarmJob::class, 'farm_job_id');
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
