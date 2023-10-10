<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;


    protected $fillable=[
        'photo',
        'name',
        'description',
        'facebook',
        'instagram',
        'github',
    ];
}
