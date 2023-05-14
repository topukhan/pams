<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'title',
        'course',
        'supervisor_id',
        'cosupervisor',
        'domain',
        'type'
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }
}
