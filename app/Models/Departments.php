<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Departments extends Model
{
    use HasFactory;

    protected $table = "departments";
    public $timestamps = false;

    protected $fillable = [
        "name",
        "description"
    ];

    protected $hidden = [];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Users::class, "departments_users", "department_id", "user_id");
    }
}
