
@extends('layouts.master')
@section('page_title', 'Yearly Expense Report')

@section('content')


<div class="content-wrapper" style="min-height: 3481.5px;">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <form method="get">
                    <div class="row mb-2">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">Select Year: <span class="text-danger">*</span></label>
                                <select name="y" id="y" class="select form-control" id="yearSelector">
            
                                    @foreach($years as $yearOption)
                                        <option value="{{ $yearOption }}" {{ $selectedYear == $yearOption ? 'selected' : '' }}>
                                            {{ $yearOption }}
                                        </option>
                                        
                                    @endforeach
            
                                </select>
                            </div>
                        </div>
            
                        

                        <div class="col-md-3 mt-lg-4">
                            <button class="btn btn-info" type="submit" id="filterButton">Filter</button>
                        </div>
                        <div class="col-md-3 mt-lg-4">
                            <a class="btn btn-info" href="{{route('view.yearly')}}">Back</a>
                        </div>
                        
                    </div>
                </form>
                
            </div>
        </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    {{-- <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div> --}}


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3" id="reportArea">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Monthly Expense Report
                                <small class="float-right">Date: {{ now()->format('d/m/Y') }}</small>
                            </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                            <address>
                                {{-- <strong>Admin, Inc.</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (804) 123-5432<br>
                                Email: info@almasaeedstudio.com
                            </address> --}}
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>{{ Auth::user()->name }}</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (555) 539-1037<br>
                                Email: john.doe@example.com
                            </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                            {{-- <b>Invoice #007612</b><br>
                            <br>
                            <b>Order ID:</b> 4F3S8J<br>
                            <b>Payment Due:</b> 2/22/2014<br>
                            <b>Account:</b> 968-34567 --}}
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                        {{-- @if (isset($expensesSummary)) --}}
                        @if(isset($noDataMessage))
                                <h5>Monthly Expense By Date Table:</h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="expenseTableBody">
                                        {{-- <tr> --}}
                                            {{-- <td> --}}
                                                {{-- </td> --}}
                                                {{-- </tr> --}}
                                            </tbody>
                                        </table>
                                        <p>{{ $noDataMessage }}</p>
                            @else                   
                                @foreach ($expensesSummary as $currencyCode => $summary )
                                    <div class="col-6 table-responsive">
                                    
                                            {{-- <h2>{{ $currencyCode }} Total: {{ $summary['total_amount'] }}</h2> --}}
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="expenseTableBody">
                                                    @php
                                                        $currencyTotal = 0;

                                                        // Initialize total amounts for each currency
                                                        $totalAmountsUSD = 0;
                                                        $totalAmountsKHR = 0;
                                                        
                                                        // Exchange rates
                                                        $exchangeRateKHRtoUSD = 0.00024; // 1 KHR = 0.00024 USD
                                                        $exchangeRateUSDtoKHR = 4119.46; // 1 USD = 4119.46 KHR


                                                        
                                                    
                                                    @endphp
                                                    @foreach ($filteredExpenses->where('currency_code', $currencyCode) as $expense)
                                                        @php
                                                            $currencyTotal += $expense->amount;                                               
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $expense->entry_date }}</td>
                                                            <td>{{ $expense->description }}</td>
                                                            <td>{{ number_format($expense->amount, 2) }} {{ $currencyCode }}</td>

                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td>Total: </td>
                                                        <td></td>
                                                        <td><strong>{{ number_format($currencyTotal, 2) }} {{ $currencyCode }}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            {{-- <h6><strong>Total: {{ number_format($currencyTotal, 2) }} {{ $currencyCode }}</strong></h6> --}}
                                        
                                    </div>
                                        @php

                                            // Loop through $expensesSummary to calculate the totals
                                            foreach ($expensesSummary as $currencyCode => $summary) {
                                                $totalAmount = $summary['total_amount'];

                                                if ($currencyCode === 'KHR') {
                                                    // Convert KHR to USD and add to the total in USD
                                                    $totalAmountsUSD += $totalAmount * $exchangeRateKHRtoUSD;
                                                } elseif ($currencyCode === 'USD') {
                                                    // Add the USD amounts to the total in USD
                                                    $totalAmountsUSD += $totalAmount;
                                                }
                                            }

                                            // Convert the total amount in USD to KHR
                                            $totalAmountsKHR = $totalAmountsUSD * $exchangeRateUSDtoKHR;
                                        
                                        @endphp
                                @endforeach
                            @endif

                        </div>

                        <div class="row mt-5 text-center">
                            {{-- @if (isset($expensesSummary)) --}}
                            @if(isset($noDataMessage))
                                
                                    <table class="table">
                                        <tbody>

                                            <tr>
                                                <th>Total Amount:</th>
                                                <td><p>{{ $noDataMessage }}</p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                            @else
                            
                                    {{-- @foreach ($expensesSummary as $currencyCode => $summary )

                                        <div class="col-6 table-responsive">                        
                                            <div class="table-responsive">
                                                    
                                                    <table class="table mt-3">
                                                        <tbody>
                                                            <tr>
                                                                <th>Total Amount:</th>
                                                                <td><strong>{{ number_format($currencyTotal, 2) }} {{ $currencyCode }}</strong></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                    @endforeach --}}
                                    {{-- <div class="row"> --}}
                                        @if (isset($totalAmountsKHR) && isset($totalAmountsUSD))
                                            <div class="col-md-6">
                                                <h6>Total Amount in KHR: <strong>{{ number_format($totalAmountsKHR, 2) }} KHR</strong> </h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Total Amount in USD: <strong>{{ number_format($totalAmountsUSD, 2) }} USD</strong> </h6>
                                            </div>
                                        @endif
                                    {{-- </div> --}}
                            @endif
                                
                            {{-- @endif --}}
                        </div>

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                            <a id="print-button" href="" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <div class="row">
                        @if (isset($totalAmountsKHR) && isset($totalAmountsUSD))
                            <div class="col-md-6">
                                <h6>Total Amount in KHR: {{ number_format($totalAmountsKHR, 2) }} KHR</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>Total Amount in USD: {{ number_format($totalAmountsUSD, 2) }} USD</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- /.content -->

    
</div>


{{-- Print report script --}}
<script>

    // document.addEventListener('DOMContentLoaded', function(){
    //     document.getElementById('filterButton').addEventListener('click', function(){
    //         // Get selected year, month and week
    //         const selectedYear = document.getElementById('y').value;
    //         const selectedMonth = document.getElementById('m').value;
    //         const selectedWeek = document.getElementById('w').value;

    //         // Construct the URL with selected parameters
    //         // const url = '/get/weekly/data?y=${selectedYear}&m=${selectedMonth}$w=${selectedWeek}';
    //         const url = '/view/weekly/report?y=' + selectedYear + '&m=' + selectedMonth + '&w=' + selectedWeek;

    //         // Redirect ot the filtered URL
    //         window.location.href = url;

    //     });
    // });




    document.getElementById("print-button").addEventListener("click", function(){
        var printContents =  document.getElementById("reportArea").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML =  printContents;

        window.print();

        document.body.innerHTML = originalContents;
    });
</script>



@endsection
