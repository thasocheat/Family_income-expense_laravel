<?php

namespace App\Models;

use App\Models\User;
use App\Models\Income;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_by_id'];

    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    // This relationship from income category to the user
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    // Relation to income model
    public function incomes()
    {
        return $this->hasMany(Income::class, 'income_category_id');
    }

}
