<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_ID',
        'user_id',
        'batch',
        'section',
        'shift',
    ];


    // public function group(){
    //     return $this->belongsTo(Group::class);
    // }
}
