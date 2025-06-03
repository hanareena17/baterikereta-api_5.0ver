<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

        static::deleting(function ($user) {
            try {
                DB::beginTransaction();

                // Delete points
                if ($user->points) {
                    Log::info('Deleting user points for user: ' . $user->id);
                    $user->points->delete();
                }

                // Delete profile
                if ($user->profile) {
                    Log::info('Deleting user profile for user: ' . $user->id);
                    $user->profile->delete();
                }

                // Delete cars
                if ($user->cars()->exists()) {
                    Log::info('Deleting user cars for user: ' . $user->id);
                    $user->cars()->delete();
                }

                // Delete payments
                if ($user->payments()->exists()) {
                    Log::info('Deleting user payments for user: ' . $user->id);
                    $user->payments()->delete();
                }

                // Delete service history
                if ($user->serviceHistory()->exists()) {
                    Log::info('Deleting user service history for user: ' . $user->id);
                    $user->serviceHistory()->delete();
                }

                // Delete tokens
                if ($user->tokens()->exists()) {
                    Log::info('Deleting user tokens for user: ' . $user->id);
                    $user->tokens()->delete();
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error in User model deleting event: ' . $e->getMessage());
                Log::error('Stack trace: ' . $e->getTraceAsString());
                throw $e;
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'ic',
        'otp',
        'otp_expires_at',
        'two_fa_enabled',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'two_fa_enabled' => 'boolean',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function cars()
    {
        return $this->hasMany(UserCar::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function serviceHistory()
    {
        return $this->hasMany(ServiceHistory::class);
    }

    /**
     * Get the points for the user.
     */
    public function points()
    {
        return $this->hasOne(UserPoint::class)->withDefault();
    }
}
