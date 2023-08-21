<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposal extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function approvalRequest()
    {
        return $this->hasOne(ProjectProposalApprovalRequest::class);
    }

    public function proposalFeedback()
    {
        return $this->hasOne(ProposalFeedback::class);
    }
}
