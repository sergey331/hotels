<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $with = ['plans'];

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
        'password' => 'hashed',
        'dob' => 'date:Y-m-d',
    ];


    public static function validateRegistration(array $data)
    {
        $rules = [
            'general' => 'required|array',
            'address' => 'required|array',
            'company' => 'required|array',
        ];

        return Validator::make($data,$rules);
    }
    public function plans()
    {
        return $this->hasMany(UserPlan::class)->with(['plan']);
    }
    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
