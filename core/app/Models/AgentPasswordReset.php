<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentPasswordReset extends Model
{
    protected $table = "agent_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
