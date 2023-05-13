<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $fillable = ['group_id','email', 'name', 'student_ID', 'batch'];

    public function group(){
        return $this->belongsTo(Group::class);
    }
}

