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
            @if(count($expenses) > 0)

                <table class="table table-bordered text-center">
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
                        @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $expense->expense_category->name ?? '' }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->description }}</td>
                            <td>{{ $expense->entry_date }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">

                                        <a href="{{ route('expenses.edit', [$expense->id]) }}"
                                           class="fas fa-edit "><i class="icon-pencil"></i></a>

                                        <a id="delete" onclick="confirmDelete(this.id)"
                                           href="{{ route('expenses.destroy', [$expense->id]) }}"
                                           class="fas fa-delete "><i class="fa-trash"></i></a>

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
                        <th>Expense Name</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                       <tr><td>You don't have any expense yet!!!</td></tr>

                    </tbody>
                </table>
            @endif
        </div>

      </div>

        </div>

        </div>
    </div>

</div>

@endsection
