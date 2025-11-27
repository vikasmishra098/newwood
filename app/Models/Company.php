<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
     protected $fillable = [
        'name',
        'customer_name',
        'comservicehidden',
        'customer_phone',
        'cosmachinename',
        'cos_address',
        'cosmachinedetail',
        'cosspareparts',
        'cossparepartsrequired',
        'cosstatus',
        
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
