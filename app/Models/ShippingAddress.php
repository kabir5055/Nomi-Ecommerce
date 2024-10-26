<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'district_id',
        'Thana_id',
        'union_id',
        'name',
        'email',
        'phone',
        'address',
    ];
}
