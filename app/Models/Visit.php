<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'employee_id', 'company_id', 'machine_name', 'date',
        'add_parts', 'required_parts', 'receive_parts',
        'start_time', 'end_time', 'who_solve', 'problem', 'status',
    ];

    // Relationship with Employee (assuming employee is a user)
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // Relationship with Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
