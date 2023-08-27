<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['notice_id', 'filename'];
    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }
    
}
