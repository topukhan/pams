<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function group(){
        return $this->hasOne(Group::class);
    }
    
    public function projectReports(){
        return $this->hasMany(ProjectReport::class);
    }
}
