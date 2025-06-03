<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserProfile extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

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