<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfit extends Model
{
    use HasFactory;

    protected $fillable = [
    'profit_amount',
    'loss_amount',
    'entry_date',
];

}
