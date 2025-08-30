<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ add this
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable; // ✅ HasFactory जोड़ो

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
