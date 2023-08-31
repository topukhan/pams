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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function projectProposal()
    {
        return $this->hasOne(ProjectProposal::class);
    }

    public function approvedGroup()
    {
        return $this->hasOne(ApprovedGroup::class);
    }

    public function projectProposalApproval()
    {
        return $this->hasOne(ProjectProposalApprovalRequest::class);
    }
    
    public function project()
    {
        return $this->hasOne(Project::class);
    }

}
