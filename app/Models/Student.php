<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Student extends Model
{
    use HasFactory;
    protected $guarded =['id'];


    // public function group(){
    //     return $this->belongsTo(Group::class);
    // }
}