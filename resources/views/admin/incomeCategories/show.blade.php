@extends('layouts.master')
@section('page_title', 'My Children')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">My Children</h6>
                    <a href="{{ route('childs.create') }}" class="btn btn-info float-right">Add more child</a>

                </div>

                <div class="card-body">
                    @if(count($childs) > 0)
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Photo</th>
                            <th>Name</th>                           
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($childs as $c)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset($c->user->photo) }}" alt="photo"></td>
                                <td>{{ $c->user->name }}</td>
                                <td>{{ $c->user->email }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            {{-- <div class="dropdown-menu dropdown-menu-left"> --}}
                                                <a href="{{ route('childs.show', Qs::hash($c->id)) }}" class="fas fa-view" title="View Child"><i class="fa-eye"></i></a>
                                                {{-- <a target="_blank" href="{{ route('marks.year_selector', Qs::hash($c->user->id)) }}" class="dropdown-item"><i class="icon-check"></i> Marksheet</a> --}}

                                            {{-- </div> --}}
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
                            <th>Photo</th>
                            <th>Name</th>
                            {{-- <th>ADM_No</th> --}}
                            {{-- <th>Section</th> --}}
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr> 
                                <td><p>You have not added or created any child yet.</p></td>
                            </tr>
                        </tbody>
                       
                    @endif
                </div>
            </div>

    {{--Student List Ends--}}
        </div>
    </div>

</div>
@endsection
