@extends('layouts.master')
@section('page_title', 'View Expense Category')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Manage Category Expense</h6>
                    <a href="{{route('ex_category.create')}}" class="btn btn-info float-right">Add Category</a>

                </div>


                <div class="card-body">


                    <div class="tab-content">

                        @if(count($ex_category) > 0)
                            <table class="table datatable-button-html5-columns text-center table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-1">S/N</th>
                                    <th class="col-7">Name</th>
                                    <th class="col-4">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ex_category as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-center">
                                            <div class="list-icons">
                                                <div class="dropdown">

                                                    {{-- <a href="{{ route('users.show', Qs::hash($u->id)) }}" title="View" class="fas fa-view p-1"><i class="fa-eye"></i></a> --}}
                                                    <a href="{{ route('ex_category.edit', Qs::hash($category->id)) }}" title="Edit" class="fas fa-edit p-1"><i class="icon-pencil"></i></a>
                                                    <a id="delete" onclick="confirmDelete(this.id)" href="{{ route('ex_category.destroy',['category_id' => Qs::hash($category->id)]) }}" class="fas fa-delete p-1"><i class="fa-trash"></i></a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <table class="table datatable-button-html5-columns">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr><td>You don't have any category yet!!!</td></tr>
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

    {{--Student List Ends--}}

@endsection
