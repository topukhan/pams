<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function group_members()
    {
        return $this->hasMany(GroupMember::class);
    }

    public function project_proposal()
    {
        return $this->hasOne(ProjectProposal::class);
    }

    public function approved_group()
    {
        return $this->hasOne(ApprovedGroup::class);
    }
}
