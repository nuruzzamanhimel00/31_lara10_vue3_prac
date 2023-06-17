<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id',
        'date',
        'fromName',
        'fromm',
        'code',
        'message',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function group(){
        return $this->belongsTo(Group::class,'group_id','id');
    }
    // public function send_by(){
    //     return $this->belongsTo(User::class,'send_by','id');
    // }
    // public function received_by(){
    //     return $this->belongsTo(User::class,'received_by','id');
    // }
}
