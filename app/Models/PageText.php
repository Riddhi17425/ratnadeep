<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageText extends Model
{
    protected $fillable = ['page', 'key', 'value'];
}
