<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_email',
        'service_phone',
        'service_requirement',
        'service_check',
    ];
}
