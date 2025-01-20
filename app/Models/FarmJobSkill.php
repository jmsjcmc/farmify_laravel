<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmJobSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_job_id',
        'skill_name',
        'skill_level'
    ];

    public function job()
    {
        return $this->belongsTo(FarmJob::class, 'farm_job_id');
    }
}
