@extends('layouts.master')
@section('page_title', 'Manage Incomes')
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
            @if(count($incomes) > 0)
           
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Income Name</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Date</th>                                        
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($incomes as $income)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $income->income_category->name ?? '' }}</td>
                            <td>{{ $income->amount }}</td>
                            <td>{{ $income->description }}</td>
                            <td>{{ $income->entry_date }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">

                                            {{-- <a href="{{ route('incomes.show', [$income->id]) }}" class="fas fa-view "><i class="fa-eye"></i></a> --}}
                                            <a href="{{ route('incomes.edit', [$income->id]) }}" class="fas fa-edit "><i class="icon-pencil"></i></a>

                                            <a id="delete" onclick="confirmDelete(this.id)" href="{{ route('users.destroy', [$income->id]) }}" class="fas fa-delete "><i class="fa-trash"></i></a>
                                            {{-- <form method="post" id="item-delete-{{ $income->id }}" action="{{ route('users.destroy', [$income->id]) }}" class="hidden">@csrf @method('delete')</form> --}}

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>   
            @else
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Income Name</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Date</th>                                        
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                       <tr><td>You don't have any income yet!!!</td></tr>

                    </tbody>
                </table>
            @endif
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
