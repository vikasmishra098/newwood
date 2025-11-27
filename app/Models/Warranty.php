<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;

    protected $fillable = [
    'name', 'email', 'address', 'city', 'state', 'pin',
    'dealer_name', 'dealer_email', 'dealer_phone', 'dealer_address',
    'dealer_city', 'dealer_state', 'ppf_category', 'chassis_no', 'model',
    'year', 'vehicle_number', 'package', 'warranty', 'replacement_warranty',
    'validity', 'mobile_number', 'date', 'user_id'
];


}
