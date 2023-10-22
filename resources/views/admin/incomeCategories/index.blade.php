@extends('layouts.master')
@section('page_title', 'Create Income Category')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">{{ trans('test.Manage Category Income') }}</h6>
                    <a href="{{route('in_category.create')}}" class="btn btn-info float-right">{{ trans('test.Add Category') }}</a>

                </div>


                <div class="card-body">


                    <div class="tab-content">

                        @if(count($in_category) > 0)
                            <table class="table datatable-button-html5-columns text-center table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-1">S/N</th>
                                    <th class="col-7">Name</th>
                                    <th class="col-4">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($in_category as $category)
                                    <tr>
                                        <td class="col-1">{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-center">
                                            <div class="list-icons">
                                                <div class="dropdown">

                                                    {{-- <a href="{{ route('users.show', Qs::hash($u->id)) }}" title="View" class="fas fa-view p-1"><i class="fa-eye"></i></a> --}}
                                                    <a href="{{ route('in_category.edit', Qs::hash($category->id)) }}" title="Edit" class="fas fa-edit p-1"><i class="icon-pencil"></i></a>
                                                    <a id="delete" onclick="confirmDelete(this.id)" href="{{ route('in_category.destroy',['category_id' => Qs::hash($category->id)]) }}" class="fas fa-delete p-1"><i class="fa-trash"></i></a>

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
                                    <th>{{ trans('test.S/N') }}</th>
                                    <th>{{ trans('test.Name') }}</th>
                                    <th>{{ trans('test.Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr><td>{{ trans('test.You dont have any category yet!!!') }}</td></tr>
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
