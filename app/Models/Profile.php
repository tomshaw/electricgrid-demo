<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'billing_address_line_1',
        'billing_address_line_2',
        'billing_city',
        'billing_state',
        'billing_zip',
        'billing_country',
        'shipping_address_line_1',
        'shipping_address_line_2',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'shipping_country',
        'phone_number',
        'profile_picture',
        'newsletter',
        'profile_badge',
        'profile_date',
        'profile_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
