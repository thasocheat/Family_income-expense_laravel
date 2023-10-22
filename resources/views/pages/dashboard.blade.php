@extends('layouts.master')
@section('page_title', 'Admin Dashboard')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif --}}
            <h1 class="m-0">{{ trans('test.Dashboard') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ trans('test.Home') }}</a></li>
              <li class="breadcrumb-item active">{{ trans('test.Dashboard') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $users->where('user_type','admin')->count() }}</h3>

                <p>{{ trans('test.Total Admin') }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>@if(!$users) {{0}} @else {{ $users->count() }} @endif</h3>

                <p>{{ trans('test.Total Users') }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $users->where('user_type','parent')->count() }}</h3>

                <p>{{ trans('test.Total Parent') }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>

           <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $users->where('user_type','child')->count() }}</h3>

                <p>{{ trans('test.Total Child') }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>@if(!$incomeCategories) {{0}} @else {{ $incomeCategories->count() }} @endif</h3>

                  <p>{{ trans('test.Total Income Category') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>@if(!$expenseCategories) {{0}} @else {{ $expenseCategories->count() }} @endif</h3>

                  <p>{{ trans('test.Total Expense Category') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>@if(!$expenses) {{0}} @else {{ $expenses->count() }} @endif</h3>

                    <p>Total Expenses</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>@if(!$incomes) {{0}} @else {{ $incomes->count() }} @endif</h3>

                    <p>Total Incomes</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                </div>
            </div>

            <!-- ./col -->
            {{-- <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $users->where('user_type','parent')->count() }}</h3>

                  <p>Total Parent</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </div>

             <!-- ./col -->
             {{-- <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>{{ $users->where('user_type','child')->count() }}</h3>

                  <p>Total Child</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </div> --}}

          </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>





@endsection
