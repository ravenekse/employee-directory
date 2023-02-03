<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Users extends Authenticatable
{
    use Notifiable, HasFactory, HasRoles;

    protected $table = "users";
    public $timestamps = false;

    protected $fillable = ["email", "password", "firstname", "surname", "phone_number", "image_url", "description"];

    protected $hidden = ["password", "remember_token"];

    /**
     * @return BelongsToMany
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Departments::class, "departments_users", "user_id", "department_id");
    }
}
