<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupParticipent extends Model
{
    use HasFactory;

    protected $filable = [
        'user_id',
        'group_id',
    ];
}
