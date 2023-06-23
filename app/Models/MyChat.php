<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'user_id',
        'message',
        'date'
    ];

    public function group(){
        return $this->belongsTo(MyChatGroup::class,'group_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
