
@extends('layouts.master')
@section('page_title', 'Weekly Report')

@section('content')


<div class="content-wrapper" style="min-height: 3481.5px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <form method="get">
            <div class="row mb-2">
            {{-- <div class="col-sm-12"> --}}

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
    
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="gender">Select Month: <span class="text-danger">*</span></label>
                        <select name="m" id="m" class="select form-control" id="monthSelector">
                            
                            @foreach($months as $index => $monthName)
                                <option value="{{ $index }}" {{ $selectedMonth == $index ? 'selected' : '' }}>
                                    {{ $monthName }}
                                </option>
                                
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="gender">Select Week: <span class="text-danger">*</span></label>
                        <select name="w" id="w" class="select form-control" id="weekSelector">
                            @for ($weekNumber = 1; $weekNumber <= $weeksInMonth; $weekNumber++)
                                <option value="{{ $weekNumber }}" {{ $weekNumber === $selectedWeek ? 'selected' : ''}}>
                                    Week {{ $weekNumber }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3 mt-lg-4">
                    <button class="btn btn-info" id="filterButton">Filter</button>
                </div>

            {{-- </div> --}}
            {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Invoice</li>
                </ol>
            </div> --}}
            </div>
        </form>
      </div><!-- /.container-fluid -->
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
                    <i class="fas fa-globe"></i> Weekly Income Report
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
                {{-- @if (isset($incomesSummary)) --}}
                @if(isset($noDataMessage))
                        <h5>Monthly Income By Date Table:</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="incomeTableBody">
                                {{-- <tr> --}}
                                    {{-- <td> --}}
                                        {{-- </td> --}}
                                        {{-- </tr> --}}
                                    </tbody>
                                </table>
                                <p>{{ $noDataMessage }}</p>
                @else                   
                        @foreach ($incomesSummary as $currencyCode => $summary )
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
                                        <tbody id="incomeTableBody">
                                            @php
                                                $currencyTotal = 0;

                                                // Initialize total amounts for each currency
                                                $totalAmountsUSD = 0;
                                                $totalAmountsKHR = 0;
                                                
                                                // Exchange rates
                                                $exchangeRateKHRtoUSD = 0.00024; // 1 KHR = 0.00024 USD
                                                $exchangeRateUSDtoKHR = 4119.46; // 1 USD = 4119.46 KHR


                                                
                                            
                                            @endphp
                                            @foreach ($filteredIncomes->where('currency_code', $currencyCode) as $income)
                                                @php
                                                    $currencyTotal += $income->amount;                                               
                                                @endphp
                                                <tr>
                                                    <td>{{ $income->entry_date }}</td>
                                                    <td>{{ $income->description }}</td>
                                                    <td>{{ number_format($income->amount, 2) }} {{ $currencyCode }}</td>

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

                                    // Loop through $incomesSummary to calculate the totals
                                    foreach ($incomesSummary as $currencyCode => $summary) {
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
                {{-- @if (isset($incomesSummary)) --}}
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
                
                        {{-- @foreach ($incomesSummary as $currencyCode => $summary )

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
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a id="print-button" href="" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


{{-- Print report script --}}
<script>

    document.getElementById("print-button").addEventListener("click", function(){
        var printContents =  document.getElementById("reportArea").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML =  printContents;

        window.print();

        document.body.innerHTML = originalContents;
    });
</script>



@endsection
