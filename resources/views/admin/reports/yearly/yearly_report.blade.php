
@extends('layouts.master')
@section('page_title', 'Yearly Report')

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
                    <i class="fas fa-globe"></i> Monthly Income Report
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
                <div class="col-6 table-responsive">
                    <h5>Yearly Income By Date Table:</h5>
                    @if(isset($noDataMessage))
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Description</th>
                            </tr>
                            </thead>
                            <tbody id="incomeTableBody">
                                <tr>
                                    <td>
                                        <p>{{ $noDataMessage }}</p>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Description</th>
                            </tr>
                            </thead>
                            <tbody id="incomeTableBody">
                                @foreach ($filteredIncomes as $income)

                                    <tr>
                                        <td>{{ $income->entry_date }}</td>
                                        <td>{{ $income->amount }}</td>
                                        <td>{{ $income->description }}</td>

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <div class="col-6 table-responsive">
                    <h5>Yearly Income Summary Table:</h5>
                    @if(isset($noDataMessage))
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody id="incomeTableBody">
        
                                    <tr>
                                        <td><p>{{ $noDataMessage }}</p></td>
        
                                    </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody id="incomeTableBody">
                            @foreach ($incomesSummary as $income)
    
                                <tr>
                                    <td>{{ $income['name'] }}</td>
                                    <td>{{ $income['amount'] }}</td>
    
                                </tr>
    
                            @endforeach
                        </tbody>
                        </table>
                    @endif
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
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
                        <table class="table">
                        <tbody>

                            <tr>
                                <th>Total Amount:</th>
                                <td>{{ $incomesTotal  }}</td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                  </div>
                </div>
                <!-- /.col -->
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
