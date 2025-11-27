<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queries extends Model
{
    use HasFactory;

    protected $fillable = [
        'qname',
        'qemail',
        'qphone',
        'qcar',
        'qcomment',
        'qfollow',
        'qpriority',
        'qstatus',
        'qtimeline',
        'qtarget_date',
    ];

    protected $casts = [
        'qtimeline' => 'array',
    ];

    // ✅ Add this method to fix the error
    public function followups()
    {
        return $this->hasMany(Followup::class, 'query_id');
    }
}
