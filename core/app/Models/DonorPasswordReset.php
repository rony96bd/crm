<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonorPasswordReset extends Model
{
    protected $table = "donor_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
