<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AdminRegisterUser extends Model
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public static function registerUser($name, $email, $password)
    {
        return self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}
