<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['employee_id', 'photo', 'location','name', 'datetime', 'type'];
    
    // app/Models/Attendance.php
public function employee()
{
    return $this->belongsTo(Employee::class, 'employee_id');
}



}
