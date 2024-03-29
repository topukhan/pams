<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guarded = ['id'];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'phone_number',
        'department',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship with supervisor model 
    public function supervisor()
    {
        return $this->hasOne(Supervisor::class);
    }

    // Relationship with student model 
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function pendingGroup()
    {
        return $this->hasOne(PendingGroup::class);
    }

    public function groupInvitation()
    {
        return $this->hasOne(GroupInvitation::class);
    }

    public function domains()
    {
        return $this->belongsToMany(Domain::class, 'domain_user', 'user_id', 'domain_id');
    }

    public function projectTypes()
    {
        return $this->belongsToMany(ProjectType::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function citations()
    {
        return $this->hasMany(Citation::class);
    }
}
