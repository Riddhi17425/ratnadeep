<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_opening_id', 'full_name', 'email', 'phone', 'position', 'experience', 'linkedin', 'resume', 'is_read',
    ];

    public function opening()
    {
        return $this->belongsTo(JobOpening::class, 'job_opening_id');
    }
}
