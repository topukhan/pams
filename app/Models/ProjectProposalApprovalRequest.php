<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposalApprovalRequest extends Model
{
    use HasFactory;
    protected $guarded =[
        'id',
        'created_at',
        'updated_at',
    ];

    public function proposal()
    {
        return $this->belongsTo(ProjectProposal::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

}
