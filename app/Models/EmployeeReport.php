<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeReport extends Model
{
    protected $fillable = [
        'customer_id',
        'task_name',
        'date',
        'time',
        'notes',
    ];

    public function employees()
    {
        return $this->belongsToMany(\App\Models\Employee::class, 'employee_report_user', 'employee_report_id', 'employee_id');
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id');
    }
}
