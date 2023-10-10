@extends('layouts.master')
@section('page_title', 'Manage Users')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Manage Users</h6>
                    <a href="{{ route('users.create') }}" class="btn btn-info float-right">Add New Users</a>
                </div>


                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="nav-item"><a href="#new-user" class="nav-link active" data-toggle="tab">All Users</a></li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Manage Users</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @foreach($user_types as $ut)
                                    <a href="#ut-{{ Qs::hash($ut->id) }}" class="dropdown-item" data-toggle="tab">{{ $ut->name }}s</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="new-user">
                            <table class="table datatable-button-html5-columns text-center">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        {{-- <th>Username</th> --}}
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $u)
                                        <tr>
                                            <td class="text-sm" style="word-break: break-word">{{ $loop->iteration }}</td>
                                            <td>
                                                @if (!empty($u->photo))
                                                    @php
                                                        $imageUrl = asset($u->photo);
                                                    @endphp
                                                    <img width="50" src="{{ $imageUrl }}" alt="User Photo">
                                                @else

                                                    <img width="50" src="{{ asset('storage/uploads/default-photo.png') }}" alt="Default Photo">

                                                @endif
                                            </td>

                                            <td class="text-sm" style="word-break: break-word">{{ $u->name }}</td>
                                            {{-- <td>{{ $u->username }}</td> --}}
                                            <td class="text-sm" style="word-break: break-word">{{ $u->phone }}</td>


                                            <td class="text-sm" style="word-break: break-word">{{ $u->email }}</td>
                                            <td class="text-sm" style="word-break: break-word">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-primary">Select</button>
                                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                              {{-- <span class="sr-only">Toggle Dropdown</span> --}}
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                {{--View Profile--}}
                                                                <a href="{{ route('users.show', Qs::hash($u->id)) }}" title="View" class="fas fa-view p-1"><i class="fa-eye mr-1"></i> Show</a><br>
                                                                {{--Edit--}}
                                                                <a href="{{ route('users.edit', Qs::hash($u->id)) }}" title="Edit" class="fas fa-edit p-1"><i class="icon-pencil mr-1"></i> Edit</a><br>
                                                                {{-- @if(Qs::userIsAdmin()) --}}

                                                                <a id="{{ Qs::hash($u->id) }}" onclick="confirmReset(this.id)" href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" title="Reset Password" class="fas fa-reset p-1"><i class="fa-box mr-1"></i> Reset Password</a><br>
                                                                <form method="post" id="item-reset-{{ Qs::hash($u->id) }}" action="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="hidden"> @csrf @method('delete') </form>
                                                                {{--Delete--}}
                                                                {{-- <a id="delete"  href="{{ route('users.destroy', Qs::hash($u->id)) }}" title="Delete" class="fas fa-delete p-1"><i class="fa-trash"></i></a> --}}
                                                                {{-- <a id="delete" onclick="confirmDelete(this.id)" href="{{ route('users.destroy', Qs::hash($u->id)) }}" class="fas fa-delete p-1"><i class="fa-trash"></i></a> --}}
                                                                <a id="delete" onclick="confirmDelete(this.id)" href="{{ route('users.destroy', Qs::hash($u->id)) }}" class="fas fa-delete p-1"><i class="fa-trash mr-1"></i> Delete</a>
                                                                {{-- <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form> --}}
                                                                {{-- @endif --}}
                                                          </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @foreach($user_types as $ut)
                            <div class="tab-pane fade" id="ut-{{Qs::hash($ut->id)}}">
                            <table class="table datatable-button-html5-columns">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        {{-- <th>Username</th> --}}
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users->where('user_type', $ut->title) as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset($u->photo) }}" alt="{{$u->name}}"></td>
                                            <td>{{ $u->name }}</td>
                                            {{-- <td>{{ $u->username }}</td> --}}
                                            <td>{{ $u->phone }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">

                                                              {{--View Profile--}}
                                                              <a href="{{ route('users.show', Qs::hash($u->id)) }}" title="View" class="fas fa-view p-1"><i class="fa-eye"></i></a>
                                                              {{--Edit--}}
                                                              <a href="{{ route('users.edit', Qs::hash($u->id)) }}" title="Edit" class="fas fa-edit p-1"><i class="icon-pencil"></i></a>
                                                          {{-- @if(Qs::userIsAdmin()) --}}

                                                                  <a id="{{ Qs::hash($u->id) }}" onclick="confirmReset(this.id)" href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" title="Reset Password" class="fas fa-reset p-1"><i class="fa-box"></i></a>
                                                                  <form method="post" id="item-reset-{{ Qs::hash($u->id) }}" action="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="hidden"> @csrf @method('delete') </form>

                                                                  {{--Delete--}}
                                                                  {{-- <a id="delete"  href="{{ route('users.destroy', Qs::hash($u->id)) }}" title="Delete" class="fas fa-delete p-1"><i class="fa-trash"></i></a> --}}
                                                                  <a id="delete" onclick="confirmDelete(this.id)" href="{{ route('users.destroy', Qs::hash($u->id)) }}" class="fas fa-delete p-1"><i class="fa-trash"></i></a>
                                                                {{-- <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form> --}}
                                                          {{-- @endif --}}

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>



        </div>
    </div>

</div>

    {{--Student List Ends--}}

@endsection
