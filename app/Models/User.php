<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail; // Add this line

class User extends Authenticatable implements MustVerifyEmail // Implement MustVerifyEmail
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified_at', // Ensure this is included for email verification
    ];

    // The attributes that should be hidden for serialization.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // The attributes that should be cast.
    protected $casts = [
        'verified_at' => 'datetime', // Change this to 'verified_at'
    ];

    // Relation with role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function discussion()
    {
        return $this->hasMany(Discussion::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
