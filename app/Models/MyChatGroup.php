<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyChatGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'code'
    ];

    public function mychat_user(){
        $this->belongsToMany(User::class,'group_users','group_id','user_id');
    }
}
