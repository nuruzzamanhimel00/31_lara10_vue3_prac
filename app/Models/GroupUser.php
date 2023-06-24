<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use App\Models\MyChatGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'user_id'
    ];

    protected $table ='group_user';

    public function group(){
        return $this->belongsTo(MyChatGroup::class,'group_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
