<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'topic',
    ];

    public function group_members(){
        return $this->hasMany(GroupMember::class);
    }
}
