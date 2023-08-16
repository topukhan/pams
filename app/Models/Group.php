<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function groupMembers()
    {
        return $this->hasMany(GroupMember::class);
    }

    public function projectProposal()
    {
        return $this->hasOne(ProjectProposal::class);
    }

    public function approvedGroup()
    {
        return $this->hasOne(ApprovedGroup::class);
    }
}
