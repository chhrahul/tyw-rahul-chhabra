<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_name',
        'yacht_name',
        'start_date',
        'end_date',
        'price',
    ];
}
