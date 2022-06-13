<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'address_type',
        'full_address',
        'division',
        'district',
        'city',
        'zip',
    ];
}
