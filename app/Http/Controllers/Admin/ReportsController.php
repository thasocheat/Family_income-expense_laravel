<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Helpers\Qs;
use App\Models\Income;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use App\Models\Expense;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    protected $user;

    public function view_weekly_index(){

        $user = auth()->user();
            
        $data['incomes'] = [];

        $data['expenses'] = [];
    
        if ($user->user_type === 'admin') {
            // Admin can see all incomes
            $data['incomes'] = Income::all();

            $data['expenses'] = Expense::all();

        } elseif ($user->user_type === 'parent') {

            // Parents can see their incomes and their children's incomes
            $data['incomes'] = Income::where('created_by_id', $user->id)
                ->orWhereIn('created_by_id', $user->children->pluck('id'))
                ->get();

            $data['expenses'] = Expense::where('created_by_id', $user->id)
                ->orWhereIn('created_by_id', $user->children->pluck('id'))
                ->get();

        } elseif ($user->user_type === 'child') {
            // Children can only see their own incomes
            $data['incomes'] = Income::where('created_by_id', $user->id)->get();

            $data['expenses'] = Expense::where('created_by_id', $user->id)->get();
        }


        // Initialize total amounts for each currency
        $data['totalAmountsUSD'] = 0;
        $data['totalAmountsKHR'] = 0;

        $data['totalAmountsUSD_ex'] = 0;
        $data['totalAmountsKHR_ex'] = 0;
        
        // Exchange rates
        $exchangeRateKHRtoUSD = 0.00024; // 1 KHR = 0.00024 USD
        $exchangeRateUSDtoKHR = 4119.46; // 1 USD = 4119.46 KHR
        

        // Loop through $incomesSummary to calculate the totals
        foreach ($data['incomes'] as $data_income) {

            if ($data_income->currency_code === 'KHR') {
                // Convert KHR to USD and add to the total in USD
                $data['totalAmountsUSD']  += $data_income->amount * $exchangeRateKHRtoUSD;
            } elseif ($data_income->currency_code === 'USD') {
                // Add the USD amounts to the total in USD
                $data['totalAmountsUSD']  += $data_income->amount;
            }
        }
        // Convert the total income amount in USD to KHR
        $data['totalAmountsKHR'] = $data['totalAmountsUSD']  * $exchangeRateUSDtoKHR;

        

        // Loop through $expenseSummary to calculate the totals
        foreach ($data['expenses'] as $data_expense) {

            if ($data_expense->currency_code === 'KHR') {
                // Convert KHR to USD and add to the total in USD
                $data['totalAmountsUSD_ex']  += $data_expense->amount * $exchangeRateKHRtoUSD;
            } elseif ($data_expense->currency_code === 'USD') {
                // Add the USD amounts to the total in USD
                $data['totalAmountsUSD_ex']  += $data_expense->amount;
            }
        }

        // Convert the total expense amount in USD to KHR
        $data['totalAmountsKHR_ex'] = $data['totalAmountsUSD_ex']  * $exchangeRateUSDtoKHR;



        // Total balance USD
        $data['toUSD'] = $data['totalAmountsUSD'] - $data['totalAmountsUSD_ex'];

        // Total balance KHR
        $data['toKHR'] = $data['totalAmountsKHR'] - $data['totalAmountsKHR_ex'];

        return view('admin.reports.weekly.show',$data);
    }

    public function weekly_index(){

        // Get the authenticate user
        $user = auth()->user();

        $year = request()->query('y', Carbon::now()->year);
        $month =  request()->query('m', Carbon::now()->month);
        $week =  request()->query('w', 1);

        // Calculate the starting and ending dates of the selected month
        $from = Carbon::create($year, $month, 1)->startOfMonth();
        $to = Carbon::create($year, $month, 1)->endOfMonth();

        // Calculate the starting and ending dates of the selected week within the selected month
        $from = $from->addWeeks($week - 1)->startOfWeek();
        $to = clone $from;
        $to->addDays(6);


        $data['selectedMonth'] = $month;


        $data['selectedYear'] = $year;

        $data['months'] = $months = Qs::months();

        // From current year to 2000
        $data['years'] = $years = range(Carbon::now()->year, 2000);

        // Calculate the number of weeks in the selected month
        $lastDayOfMonth = Carbon::create($year, $month)->endOfMonth();

        $weeksInMonth = $lastDayOfMonth->weekOfMonth;

        $data['selectedWeek'] = $week;


        $filteredIncomes = Income::with('income_category')
            ->where(function($query) use ($user){
                if(Qs::userIsAdmin()){

                }elseif(Qs::userIsParent()){
                    $query->where('created_by_id',$user->id)
                        ->orWhereIn('created_by_id',$user->children->pluck('id'));
                }else{
                    $query->where('created_by_id',$user->id);
                }
            })
            ->whereBetween('entry_date', [$from, $to])
            ->whereNotNull('income_category_id')
            ->orderBy('amount', 'desc')
            ->get();


        $incomesSummary = [];

        // Check filter
        if($filteredIncomes->isEmpty()){
            // No data found, set a message
            $data['noDataMessage'] = "No data found for the selected year and month.";
        }else{

            $incomesTotal = $filteredIncomes->sum('amount');

            // Group the filtered incomes by currency_code
            $groupedIncoems = $filteredIncomes->groupBy('currency_code');


            foreach($groupedIncoems as $currencyCode => $incomes){
                    // $incomeCategory = $incomes->first()->income_category->name;
                    // $incomesSummary[$incomeCategory] = [
                    //     'name' => $incomeCategory,
                    //     'amount' => $incomes->sum('amount'),
                    // ];

                    $totalAmount = $incomes->sum('amount');

                    $incomesSummary[$currencyCode] = [
                        'currency_code' => $currencyCode,
                        'total_amount' => $totalAmount,
                    ];

            }

            $data = [
                'incomesTotal' => $incomesTotal,
                // 'weeksInMonth' => $weeksInMonth,
                'selectedWeek' => $week,
                'selectedMonth' => $month,
                'months' => $months,
                'week' => $week,
                'selectedYear' => $year,
                'years' => $years,
                'filteredIncomes' => $filteredIncomes,
                'incomesSummary' => $incomesSummary,

            ];
        }

        $data['incomesSummary'] = $incomesSummary;

        return view('admin.reports.weekly.index',$data,compact('weeksInMonth'));
        // return dd($weeksInMonth);
    }

    public function get_weekly_expense(){

        // Get the authenticate user
        $user = auth()->user();

        $year = request()->query('y', Carbon::now()->year);
        $month =  request()->query('m', Carbon::now()->month);
        $week =  request()->query('w', 1);

        // Calculate the starting and ending dates of the selected month
        $from = Carbon::create($year, $month, 1)->startOfMonth();
        $to = Carbon::create($year, $month, 1)->endOfMonth();

        // Calculate the starting and ending dates of the selected week within the selected month
        $from = $from->addWeeks($week - 1)->startOfWeek();
        $to = clone $from;
        $to->addDays(6);


        $data['selectedMonth'] = $month;


        $data['selectedYear'] = $year;

        $data['months'] = $months = Qs::months();

        // From current year to 2000
        $data['years'] = $years = range(Carbon::now()->year, 2000);

        // Calculate the number of weeks in the selected month
        $lastDayOfMonth = Carbon::create($year, $month)->endOfMonth();

        $weeksInMonth = $lastDayOfMonth->weekOfMonth;

        $data['selectedWeek'] = $week;


        $filteredExpenses = Expense::with('expense_category')
            ->where(function($query) use ($user){
                if(Qs::userIsAdmin()){

                }elseif(Qs::userIsParent()){
                    $query->where('created_by_id',$user->id)
                        ->orWhereIn('created_by_id',$user->children->pluck('id'));
                }else{
                    $query->where('created_by_id',$user->id);
                }
            })
            ->whereBetween('entry_date', [$from, $to])
            ->whereNotNull('expense_category_id')
            ->orderBy('amount', 'desc')
            ->get();

        // Check filter
        if($filteredExpenses->isEmpty()){
            // No data found, set a message
            $data['noDataMessage'] = "No data found for the selected year and month.";
        }else{

            $expensesTotal = $filteredExpenses->sum('amount');

            // Group the filtered expenses by income category
            $groupedExpenses = $filteredExpenses->groupBy('currency_code');

            foreach($groupedExpenses as $currencyCode => $expenses){
                    // $expenseCategory = $expenses->first()->expense_category->name;
                    // $expensesSummary[$expenseCategory] = [
                    //     'name' => $expenseCategory,
                    //     'amount' => $expenses->sum('amount'),
                    // ];
                    $totalAmount = $expenses->sum('amount');

                    $expensesSummary[$currencyCode] = [
                        'currency_code' => $currencyCode,
                        'total_amount' => $totalAmount,
                    ];

            }

            $data = [
                'expensesTotal' => $expensesTotal,
                // 'weeksInMonth' => $weeksInMonth,
                'selectedWeek' => $week,
                'selectedMonth' => $month,
                'months' => $months,
                'week' => $week,
                'selectedYear' => $year,
                'years' => $years,
                'filteredExpenses' => $filteredExpenses,
                'expensesSummary' => $expensesSummary,

            ];
        }

        return view('admin.reports.weekly.expense_index',$data,compact('weeksInMonth'));
        // return dd($weeksInMonth);
    }

    // End weekly report

    // =======================================================

    // For monthly report

    public function view_monthly_report(){

        $user = auth()->user();
            
        $data['incomes'] = [];

        $data['expenses'] = [];
    
        if ($user->user_type === 'admin') {
            // Admin can see all incomes
            $data['incomes'] = Income::all();

            $data['expenses'] = Expense::all();

        } elseif ($user->user_type === 'parent') {

            // Parents can see their incomes and their children's incomes
            $data['incomes'] = Income::where('created_by_id', $user->id)
                ->orWhereIn('created_by_id', $user->children->pluck('id'))
                ->get();

            $data['expenses'] = Expense::where('created_by_id', $user->id)
                ->orWhereIn('created_by_id', $user->children->pluck('id'))
                ->get();

        } elseif ($user->user_type === 'child') {
            // Children can only see their own incomes
            $data['incomes'] = Income::where('created_by_id', $user->id)->get();

            $data['expenses'] = Expense::where('created_by_id', $user->id)->get();
        }


        // Initialize total amounts for each currency
        $data['totalAmountsUSD'] = 0;
        $data['totalAmountsKHR'] = 0;

        $data['totalAmountsUSD_ex'] = 0;
        $data['totalAmountsKHR_ex'] = 0;
        
        // Exchange rates
        $exchangeRateKHRtoUSD = 0.00024; // 1 KHR = 0.00024 USD
        $exchangeRateUSDtoKHR = 4119.46; // 1 USD = 4119.46 KHR
        

        // Loop through $incomesSummary to calculate the totals
        foreach ($data['incomes'] as $data_income) {

            if ($data_income->currency_code === 'KHR') {
                // Convert KHR to USD and add to the total in USD
                $data['totalAmountsUSD']  += $data_income->amount * $exchangeRateKHRtoUSD;
            } elseif ($data_income->currency_code === 'USD') {
                // Add the USD amounts to the total in USD
                $data['totalAmountsUSD']  += $data_income->amount;
            }
        }
        // Convert the total income amount in USD to KHR
        $data['totalAmountsKHR'] = $data['totalAmountsUSD']  * $exchangeRateUSDtoKHR;

        

        // Loop through $expenseSummary to calculate the totals
        foreach ($data['expenses'] as $data_expense) {

            if ($data_expense->currency_code === 'KHR') {
                // Convert KHR to USD and add to the total in USD
                $data['totalAmountsUSD_ex']  += $data_expense->amount * $exchangeRateKHRtoUSD;
            } elseif ($data_expense->currency_code === 'USD') {
                // Add the USD amounts to the total in USD
                $data['totalAmountsUSD_ex']  += $data_expense->amount;
            }
        }

        // Convert the total expense amount in USD to KHR
        $data['totalAmountsKHR_ex'] = $data['totalAmountsUSD_ex']  * $exchangeRateUSDtoKHR;



        // Total balance USD
        $data['toUSD'] = $data['totalAmountsUSD'] - $data['totalAmountsUSD_ex'];

        // Total balance KHR
        $data['toKHR'] = $data['totalAmountsKHR'] - $data['totalAmountsKHR_ex'];

        return view('admin.reports.monthly.show',$data);
    }
    
    public function get_monthly(){
        // Get the authenticate user
        $user = auth()->user();

        $year = request()->query('y', Carbon::now()->year);
        $month =  request()->query('m', Carbon::now()->month);

        // Calculate the starting and ending dates of the selected month
        $from = Carbon::create($year, $month, 1)->startOfMonth();
        $to = Carbon::create($year, $month, 1)->endOfMonth();


        $data['selectedMonth'] = $month;


        $data['selectedYear'] = $year;

        $data['months'] = $months = Qs::months();

        // From current year to 2000
        $data['years'] = $years = range(Carbon::now()->year, 2000);


        $filteredIncomes = Income::with('income_category')
            ->where(function($query) use ($user){
                if(Qs::userIsAdmin()){

                }elseif(Qs::userIsParent()){
                    $query->where('created_by_id',$user->id)
                        ->orWhereIn('created_by_id',$user->children->pluck('id'));
                }else{
                    $query->where('created_by_id',$user->id);
                }
            })
            ->whereBetween('entry_date', [$from, $to])
            ->whereNotNull('income_category_id')
            ->orderBy('amount', 'desc')
            ->get();

        $incomesSummary = [];


        // Check filter
        if($filteredIncomes->isEmpty()){
            // No data found, set a message
            $data['noDataMessage'] = "No data found for the selected year and month.";
        }else{

            // $incomesTotal = $filteredIncomes->sum('amount');

            // Group the filtered incomes by currency_code
            $groupedIncoems = $filteredIncomes->groupBy('currency_code');


            foreach($groupedIncoems as $currencyCode => $incomes){
                    // $incomeCategory = $incomes->first()->income_category->name;
                    // $incomesSummary[$incomeCategory] = [
                    //     'name' => $incomeCategory,
                    //     'amount' => $incomes->sum('amount'),
                    // ];
                    $totalAmount = $incomes->sum('amount');

                    $incomesSummary[$currencyCode] = [
                        'currency_code' => $currencyCode,
                        'total_amount' => $totalAmount,
                    ];

            }

            $data = [
                // 'incomesTotal' => $incomesTotal,
                'selectedMonth' => $month,
                'months' => $months,
                'selectedYear' => $year,
                'years' => $years,

                'filteredIncomes' => $filteredIncomes,
                // 'totalAmountKHR_USD' => $totalAmountsKHR,

            ];

        }
        $data['incomesSummary'] = $incomesSummary;

        return view('admin.reports.monthly.monthly_report',$data);


    }

    public function get_monthly_expense(){
        // Get the authenticate user
        $user = auth()->user();

        $year = request()->query('y', Carbon::now()->year);
        $month =  request()->query('m', Carbon::now()->month);

        // Calculate the starting and ending dates of the selected month
        $from = Carbon::create($year, $month, 1)->startOfMonth();
        $to = Carbon::create($year, $month, 1)->endOfMonth();


        $data['selectedMonth'] = $month;


        $data['selectedYear'] = $year;

        $data['months'] = $months = Qs::months();

        // From current year to 2000
        $data['years'] = $years = range(Carbon::now()->year, 2000);


        $filteredExpenses = Expense::with('expense_category')
            ->where(function($query) use ($user){
                if(Qs::userIsAdmin()){

                }elseif(Qs::userIsParent()){
                    $query->where('created_by_id',$user->id)
                        ->orWhereIn('created_by_id',$user->children->pluck('id'));
                }else{
                    $query->where('created_by_id',$user->id);
                }
            })
            ->whereBetween('entry_date', [$from, $to])
            ->whereNotNull('expense_category_id')
            ->orderBy('amount', 'desc')
            ->get();

        $expensesSummary = [];


        // Check filter
        if($filteredExpenses->isEmpty()){
            // No data found, set a message
            $data['noDataMessage'] = "No data found for the selected year and month.";
        }else{


            // Group the filtered expenses by income category
            $groupedExpenses = $filteredExpenses->groupBy('currency_code');


            foreach($groupedExpenses as $currencyCode => $expenses){
                    
                    $totalAmount = $expenses->sum('amount');

                    $expensesSummary[$currencyCode] = [
                        'currency_code' => $currencyCode,
                        'total_amount' => $totalAmount,
                    ];

            }

            $data = [
                // 'incomesTotal' => $incomesTotal,
                'selectedMonth' => $month,
                'months' => $months,
                'selectedYear' => $year,
                'years' => $years,

                'filteredExpenses' => $filteredExpenses,
                // 'totalAmountKHR_USD' => $totalAmountsKHR,

            ];

        }
        $data['expensesSummary'] = $expensesSummary;

        return view('admin.reports.monthly.expense_monthly_report',$data);


    }

    // End monthly report

    // =======================================================

    // For yearly report

    public function view_yearly_index(){

        $user = auth()->user();
            
        $data['incomes'] = [];

        $data['expenses'] = [];
    
        if ($user->user_type === 'admin') {
            // Admin can see all incomes
            $data['incomes'] = Income::all();

            $data['expenses'] = Expense::all();

        } elseif ($user->user_type === 'parent') {

            // Parents can see their incomes and their children's incomes
            $data['incomes'] = Income::where('created_by_id', $user->id)
                ->orWhereIn('created_by_id', $user->children->pluck('id'))
                ->get();

            $data['expenses'] = Expense::where('created_by_id', $user->id)
                ->orWhereIn('created_by_id', $user->children->pluck('id'))
                ->get();

        } elseif ($user->user_type === 'child') {
            // Children can only see their own incomes
            $data['incomes'] = Income::where('created_by_id', $user->id)->get();

            $data['expenses'] = Expense::where('created_by_id', $user->id)->get();
        }


        // Initialize total amounts for each currency
        $data['totalAmountsUSD'] = 0;
        $data['totalAmountsKHR'] = 0;

        $data['totalAmountsUSD_ex'] = 0;
        $data['totalAmountsKHR_ex'] = 0;
        
        // Exchange rates
        $exchangeRateKHRtoUSD = 0.00024; // 1 KHR = 0.00024 USD
        $exchangeRateUSDtoKHR = 4119.46; // 1 USD = 4119.46 KHR
        

        // Loop through $incomesSummary to calculate the totals
        foreach ($data['incomes'] as $data_income) {

            if ($data_income->currency_code === 'KHR') {
                // Convert KHR to USD and add to the total in USD
                $data['totalAmountsUSD']  += $data_income->amount * $exchangeRateKHRtoUSD;
            } elseif ($data_income->currency_code === 'USD') {
                // Add the USD amounts to the total in USD
                $data['totalAmountsUSD']  += $data_income->amount;
            }
        }
        // Convert the total income amount in USD to KHR
        $data['totalAmountsKHR'] = $data['totalAmountsUSD']  * $exchangeRateUSDtoKHR;

        

        // Loop through $expenseSummary to calculate the totals
        foreach ($data['expenses'] as $data_expense) {

            if ($data_expense->currency_code === 'KHR') {
                // Convert KHR to USD and add to the total in USD
                $data['totalAmountsUSD_ex']  += $data_expense->amount * $exchangeRateKHRtoUSD;
            } elseif ($data_expense->currency_code === 'USD') {
                // Add the USD amounts to the total in USD
                $data['totalAmountsUSD_ex']  += $data_expense->amount;
            }
        }

        // Convert the total expense amount in USD to KHR
        $data['totalAmountsKHR_ex'] = $data['totalAmountsUSD_ex']  * $exchangeRateUSDtoKHR;



        // Total balance USD
        $data['toUSD'] = $data['totalAmountsUSD'] - $data['totalAmountsUSD_ex'];

        // Total balance KHR
        $data['toKHR'] = $data['totalAmountsKHR'] - $data['totalAmountsKHR_ex'];

        return view('admin.reports.yearly.show',$data);
    }

    public function get_yearly_income(){
        // Get the authenticate user
        $user = auth()->user();

        $year = request()->query('y', Carbon::now()->year);

        // Calculate the starting and ending dates of the selected year
        $from = Carbon::create($year, 1, 1)->startOfMonth();
        $to = Carbon::create($year, 12, 1)->endOfMonth();


        $data['selectedYear'] = $year;

        // From current year to 2000
        $data['years'] = $years = range(Carbon::now()->year, 2000);


        $filteredIncomes = Income::with('income_category')
            ->where(function($query) use ($user){
                if(Qs::userIsAdmin()){

                }elseif(Qs::userIsParent()){
                    $query->where('created_by_id',$user->id)
                        ->orWhereIn('created_by_id',$user->children->pluck('id'));
                }else{
                    $query->where('created_by_id',$user->id);
                }
            })
            ->whereBetween('entry_date', [$from, $to])
            ->whereNotNull('income_category_id')
            ->orderBy('amount', 'desc')
            ->get();

        // Check filter
        if($filteredIncomes->isEmpty()){
            // No data found, set a message
            $data['noDataMessage'] = "No data found for the selected year.";
        }else{

            // $incomesTotal = $filteredIncomes->sum('amount');

            // // Group the filtered incomes by income category
            // $groupedIncoems = $filteredIncomes->groupBy('income_category_id');

            // $incomesSummary = [];

            // foreach($groupedIncoems as $incomeCategoryId => $incomes){
            //         $incomeCategory = $incomes->first()->income_category->name;
            //         $incomesSummary[$incomeCategory] = [
            //             'name' => $incomeCategory,
            //             'amount' => $incomes->sum('amount'),
            //         ];

            // }

            // Group the filtered incomes by currency_code
            $groupedIncoems = $filteredIncomes->groupBy('currency_code');


            foreach($groupedIncoems as $currencyCode => $incomes){
                    // $incomeCategory = $incomes->first()->income_category->name;
                    // $incomesSummary[$incomeCategory] = [
                    //     'name' => $incomeCategory,
                    //     'amount' => $incomes->sum('amount'),
                    // ];
                    $totalAmount = $incomes->sum('amount');

                    $incomesSummary[$currencyCode] = [
                        'currency_code' => $currencyCode,
                        'total_amount' => $totalAmount,
                    ];

            }

            $data = [
                // 'incomesTotal' => $incomesTotal,
                'selectedYear' => $year,
                'years' => $years,

                'filteredIncomes' => $filteredIncomes,
                'incomesSummary' => $incomesSummary,

            ];

        }


        return view('admin.reports.yearly.yearly_report',$data);


    }

    public function get_yearly_expense(){
        // Get the authenticate user
        $user = auth()->user();

        $year = request()->query('y', Carbon::now()->year);

        // Calculate the starting and ending dates of the selected year
        $from = Carbon::create($year, 1, 1)->startOfMonth();
        $to = Carbon::create($year, 12, 1)->endOfMonth();


        $data['selectedYear'] = $year;

        // From current year to 2000
        $data['years'] = $years = range(Carbon::now()->year, 2000);


        $filteredExpenses = Expense::with('expense_category')
            ->where(function($query) use ($user){
                if(Qs::userIsAdmin()){

                }elseif(Qs::userIsParent()){
                    $query->where('created_by_id',$user->id)
                        ->orWhereIn('created_by_id',$user->children->pluck('id'));
                }else{
                    $query->where('created_by_id',$user->id);
                }
            })
            ->whereBetween('entry_date', [$from, $to])
            ->whereNotNull('expense_category_id')
            ->orderBy('amount', 'desc')
            ->get();

        // Check filter
        if($filteredExpenses->isEmpty()){
            // No data found, set a message
            $data['noDataMessage'] = "No data found for the selected year.";
        }else{

            // $expensesTotal = $filteredExpenses->sum('amount');

            // // Group the filtered incomes by income category
            // $groupedExpenses = $filteredExpenses->groupBy('expense_category_id');

            // $expensesSummary = [];

            // foreach($groupedExpenses as $expensesCategoryId => $incomes){
            //         $expensesCategory = $incomes->first()->expense_category->name;
            //         $expensesSummary[$expensesCategory] = [
            //             'name' => $expensesCategory,
            //             'amount' => $incomes->sum('amount'),
            //         ];

            // }

            // Group the filtered expenses by income category
            $groupedExpenses = $filteredExpenses->groupBy('currency_code');


            foreach($groupedExpenses as $currencyCode => $expenses){
                    
                    $totalAmount = $expenses->sum('amount');

                    $expensesSummary[$currencyCode] = [
                        'currency_code' => $currencyCode,
                        'total_amount' => $totalAmount,
                    ];

            }

            $data = [
                // 'expensesTotal' => $expensesTotal,
                'selectedYear' => $year,
                'years' => $years,

                'filteredExpenses' => $filteredExpenses,
                'expensesSummary' => $expensesSummary,

            ];

        }


        return view('admin.reports.yearly.yearly_expense_report',$data);


    }
}
