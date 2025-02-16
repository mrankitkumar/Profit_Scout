<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'email',
        'password',
        'last_name',
        'mobile_number',
        'address_line_1',
        'address_line_2',
        'city',
        'country',
        'postal_code',
        'profile_picture',
        'website_link'




    ];
}
