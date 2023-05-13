<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorAvailability extends Model
{
    use HasFactory;
    protected $guarded = "id";
    // Relationship with Users table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // creating event to synchronize the user information
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($availability) {
            $availability->first_name = $availability->user->fist_name;
            $availability->last_name = $availability->user->last_name;
            $availability->email = $availability->user->email;
            $availability->phone = $availability->user->phone;
        });
    }
}
