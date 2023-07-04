@extends('layouts.master')
@section('page_title', 'Manage Users')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        
        <div class="container-fluid">

           

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Bordered Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @foreach($incomes as $income)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Income Name</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Date</th>                                        
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $income->income_category->name }}</td>
                        <td>{{ $income->amount }}</td>
                        {{-- <td>{{  $income->income_currency->symbol . ' ' . number_format($income->amount, 2, $income->income_currency->money_format_decimal, $income->income_currency->money_format_thousands) }}</td> --}}
                        <td>{{ $income->entry_date }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">

                                        <a href="{{ route('users.show', [$income->id]) }}" class="fas fa-view "><i class="icon-eye"></i> View Income</a>
                                        <a href="{{ route('users.edit', [$income->id]) }}" class="fas fa-edit "><i class="icon-pencil"></i> Edit</a>

                                        <a id="{{ $income->id }}" onclick="confirmDelete(this.id)" href="#" class="fas fa-delete "><i class="icon-trash"></i> Delete</a>
                                        <form method="post" id="item-delete-{{ $income->id }}" action="{{ route('users.destroy', [$income->id]) }}" class="hidden">@csrf @method('delete')</form>

                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        
    @endforeach
        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div> --}}
      </div>

        </div>
            
        </div>
    </div>

</div>

    {{--Student List Ends--}}

@endsection
