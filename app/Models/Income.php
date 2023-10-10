<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Income extends Model
{
    use HasFactory;
    protected $table = 'incomes';


    protected $fillable = ['entry_date', 'amount','currency_code', 'income_category_id', 'created_by_id'];

    public function setIncomeCategoryIdAttribute($input)
    {
        $this->attributes['income_category_id'] = $input ? $input : null;
    }
    // public function setEntryDateAttribute($input)
    // {
    //     if ($input != null && $input != '') {
    //         $this->attributes['entry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
    //     } else {
    //         $this->attributes['entry_date'] = null;
    //     }
    // }
    // public function getEntryDateAttribute($input)
    // {
    //     $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

    //     if ($input != $zeroDate && $input != null) {
    //         return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
    //     } else {
    //         return '';
    //     }
    // }

    // Set create by user
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    // Have relationship to incomeCategory table by
    public function income_category()
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id');
    }

    // Have relationship to user table
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

}
