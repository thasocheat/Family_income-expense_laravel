<?php

namespace App\Models;

use App\Models\ExpenseCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';

    protected $fillable = ['entry_date', 'amount', 'currency_code', 'expense_category_id', 'created_by_id'];

    public function setIncomeCategoryIdAttribute($input)
    {
        $this->attributes['expense_category_id'] = $input ? $input : null;
    }

    // Set create by user
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    // Have relationship to expenseCategory table by
    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    // Have relationship to user table
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }


}
