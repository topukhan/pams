<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase3 extends Model
{
    use HasFactory;
    protected $table = 'phase3';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
