<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'designation',
        'address',
        'customer_id',
        'company_id',
        'date',
    'time',
    ];

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id');
    }
}
