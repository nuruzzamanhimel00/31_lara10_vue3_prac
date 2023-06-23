<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Group;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function participants(){
        return $this->belongsToMany(User::class, 'group_participents','group_id','user_id' )
        ->withTimestamps();
    }

    public function group_member(){
        return $this->belongsToMany(Group::class, 'group_participents','user_id','group_id' )
        ->withTimestamps()
        ->orderBy('updated_at', 'desc');
    }

    //mychat realtion
    public function mychatGroup(){
        return $this->belongsToMany(Group::class, 'group_user','user_id','group_id')
        ->withTimestamps();
    }

    // public function participants()
    // {
    //     return $this->belongsToMany('App\Models\User', 'group_participants', 'group_id', 'user_id');
    // }

    // public function group_member()
    // {
    //     return $this->belongsToMany('App\Models\Group', 'group_participants')->orderBy('updated_at', 'desc');
    // }
}
