<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable implements MustVerifyEmail

{
    use HasFactory, Notifiable;

    protected $guard = 'agent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function blood()
    {
        return $this->belongsTo(Blood::class, 'blood_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}
