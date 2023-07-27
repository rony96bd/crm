<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPasswordReset extends Model
{
    protected $table = "user_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
