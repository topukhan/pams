<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalFeedback extends Model
{
    protected $table = 'proposal_feedbacks';
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function projectProposal(){
        return $this->belongsTo(ProjectProposal::class);
    }
}
