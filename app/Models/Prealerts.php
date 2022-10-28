<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prealerts extends Model
{
    use HasFactory;
    protected $table = 'prealert';
    protected $fillable = [
        'date',
        'shipper_id',
        'description',
        'courier _id',
        'itemcost',
        'weight',
        'tracking_number',
        'customer_id',
    ];
}
