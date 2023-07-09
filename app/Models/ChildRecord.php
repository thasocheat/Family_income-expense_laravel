<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'my_income_id',
        'my_expense_id',
        'my_parent_id',
        'age',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function my_parent()
    {
        return $this->belongsTo(User::class, 'my_parent_id');
    }

    // Add the deleting event to handle cascading delete
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($childUser) {
    //         $childUser->my_parent()->delete();
    //     });
    // }

    public function my_income()
    {
        return $this->belongsTo(Income::class);
    }

    public function my_expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
