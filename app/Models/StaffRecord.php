<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRecord extends Model
{
    use HasFactory;

    protected $fillable = ['emp_date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
