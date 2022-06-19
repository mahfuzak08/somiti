<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'dob',
        'relation',
        'share',
        'father_name',
        'mother_name',
        'address_id',
        'img',
        'nid',
    ];
}
