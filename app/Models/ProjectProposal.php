<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'course',
        'supervisor',
        'cosupervisor',
        'domain',
        'type'
    ];
}
