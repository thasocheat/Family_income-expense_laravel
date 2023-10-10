@extends('layouts.master')
@section('page_title', 'Yearly Report')

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
            <h1 class="m-0">Welcome To Report Session</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Session</li>
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
                {{-- <h3>{{ $users->where('user_type','admin')->count() }}</h3> --}}
                <h3>0</h3>
                <p>Total Income KHR</p>
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
                {{-- <h3>@if(!$users) {{0}} @else {{ $users->count() }} @endif</h3> --}}
                <h3>0</h3>
                <p>Total Income USD</p>
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
                {{-- <h3>{{ $users->where('user_type','parent')->count() }}</h3> --}}

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
                {{-- <h3>{{ $users->where('user_type','child')->count() }}</h3> --}}

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
                <a href="">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <h5 class="card-title">Income Report</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-6">
                <a href="">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <h5 class="card-title">Expense Report</h5>
                        </div>
                    </div>
                </a>
            </div>

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection