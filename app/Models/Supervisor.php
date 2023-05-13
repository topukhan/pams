<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'faculty_id',
        'designation',
        'availability',
        'expertise_area',
    ];

    // Relationship with Users table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
