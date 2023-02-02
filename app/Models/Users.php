<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = "users";
    public $timestamps = false;

    protected $fillable = [
        "email",
        "password",
        "firstname",
        "surname",
        "phone_number",
        "image_url",
        "description",
        "departments",
    ];

    protected $hidden = ["password", "remember_token"];
}
