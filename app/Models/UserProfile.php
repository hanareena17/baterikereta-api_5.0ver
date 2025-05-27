<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'postcode',
        'state',
        'profile_image',
        'gender',
        'dob',
        'ic'
    ];

    protected $casts = [
        'user_id' => 'string',
        'dob' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 