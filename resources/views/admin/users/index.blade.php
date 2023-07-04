@extends('layouts.master')
@section('page_title', 'Manage Users')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Manage Users</h6>
                    {!! Qs::getPanelOptions() !!}
                </div>


                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight">
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


                        @foreach($user_types as $ut)
                            <div class="tab-pane fade" id="ut-{{Qs::hash($ut->id)}}">
                            <table class="table datatable-button-html5-columns">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users->where('user_type', $ut->title) as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $u->photo }}" alt="photo"></td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->username }}</td>
                                            <td>{{ $u->phone }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        {{-- <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a> --}}

                                                        {{-- <div class="dropdown-menu dropdown-menu-left"> --}}
                                                            {{--View Profile--}}
                                                            <a href="{{ route('users.show', Qs::hash($u->id)) }}" class="fas fa-view "><i class="icon-eye"></i> View Profile</a>
                                                            {{--Edit--}}
                                                            <a href="{{ route('users.edit', Qs::hash($u->id)) }}" class="fas fa-edit "><i class="icon-pencil"></i> Edit</a>
                                                        {{-- @if(Qs::userIsAdmin()) --}}

                                                                <a href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="fas fa-reset "><i class="icon-lock"></i> Reset password</a>
                                                                {{--Delete--}}
                                                                <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">
                                                                    @csrf @method('delete') @method('PUT')
                                                                    <a id="{{ Qs::hash($u->id) }}" onclick="confirmDelete(this.id)" href="{{ route('users.destroy', Qs::hash($u->id)) }}" class="fas fa-delete "><i class="icon-trash"></i> Delete</a>

                                                                </form>
                                                        {{-- @endif --}}

                                                        {{-- </div> --}}
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
