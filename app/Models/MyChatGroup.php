<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MyChatGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'code',
        'status',
    ];

    public function mychatUsers(){
        return $this->belongsToMany(User::class,'group_user','group_id','user_id')
        ->withTimestamps();
    }
}
