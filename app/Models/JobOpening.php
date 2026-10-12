<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOpening extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'department', 'area', 'location', 'experience', 'qualification', 'sort_order', 'status',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
