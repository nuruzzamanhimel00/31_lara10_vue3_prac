<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'admin_id',
    ];

    public function participants(){
        return $this->belongsToMany(User::class, 'group_participents','group_id','user_id' )
        ->withTimestamps();
    }
}
