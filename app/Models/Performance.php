<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'score',
    ];
    
    
    // Performance.php
public function employee() {
    return $this->belongsTo(Employee::class, 'employee_id');
}

}

