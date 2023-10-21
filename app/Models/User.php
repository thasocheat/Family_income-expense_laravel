<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Income;
use App\Models\ChildRecord;
use App\Models\StaffRecord;
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'code',
        'password',
        'username',
        'phone',
        'phone2',
        'dob',
        'user_type',
        'gender',
        'photo',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function child_record()
    {
        return $this->hasOne(ChildRecord::class);
    }
    // Relationship to parent user for the child user
    public function children()
    {
        return $this->hasMany(ChildRecord::class, 'my_parent_id');
    }

    // public function staff()
    // {
    //     return $this->hasOne(StaffRecord::class);
    // }

    public function findByEmail($query, $email)
    {
        return $query->where('email', $email)->first();
    }


    // Income Category
    public function incomeCategories()
    {
        return $this->hasMany(IncomeCategory::class, 'created_by_id');
    }

     // Income
     public function incomes()
     {
         return $this->hasMany(Income::class, 'created_by_id');
     }
     public function expenses()
     {
         return $this->hasMany(Expense::class, 'created_by_id');
     }

    // Expense Category
    public function expenseCategories()
    {
        return $this->hasMany(ExpenseCategory::class, 'created_by_id');
    }


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
