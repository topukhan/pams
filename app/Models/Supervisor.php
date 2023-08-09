<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $guarded =[
        'id',
        'created_at',
        'updated_at',
    ];

    // Relationship with Users table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
