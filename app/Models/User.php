<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ["username","email","password","token", "rule","foto_profile"];
    protected $hidden = ["password"];
}
