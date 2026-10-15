<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappInquiry extends Model
{
    protected $fillable = ['phone', 'message'];
}