<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable 
{
    use HasFactory;
    use Notifiable;

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number'
    ];
}
