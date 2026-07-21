<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'contacts',
        'emails',
        'facebook',
        'linkedin',
        'instagram',
    ];

    protected $casts = [
        'contacts' => 'array',
        'emails'   => 'array',
    ];
}