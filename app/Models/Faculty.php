<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Faculty extends Model
{
    use HasFactory;
    use Notifiable;

    public function getAuthIdentifierName()
    {
        return 'id'; 
    }
}
