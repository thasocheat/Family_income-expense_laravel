@extends('layouts.master')
@section('page_title', 'Child Profile - '.$cr->user->name)
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-body">
                            <img style="width: 90%; height:90%" src="{{ asset($cr->user->photo) }}" alt="photo" class="rounded-circle">
                            <br>
                            <h3 class="mt-3">{{ $cr->user->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-highlight">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">{{ $cr->user->name }}</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                {{--Basic Info--}}
                                <div class="tab-pane fade show active" id="basic-info">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Name</td>
                                            <td>{{ $cr->user->name }}</td>
                                        </tr>
                                    
                                        @if($cr->my_parent_id)
                                            <tr>
                                                <td class="font-weight-bold">Parent</td>
                                                <td>
                                                    <span><a target="_blank" href="{{ route('users.show', Qs::hash($cr->my_parent_id)) }}">{{ $cr->my_parent->name }}</a></span>
                                                </td>
                                            </tr>
                                        @endif
                                    
                                        <tr>
                                            <td class="font-weight-bold">Gender</td>
                                            <td>{{ $cr->user->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Address</td>
                                            <td>{{ $cr->user->address }}</td>
                                        </tr>
                                        @if($cr->user->email)
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>{{$cr->user->email }}</td>
                                        </tr>
                                        @endif
                                        @if($cr->user->phone)
                                            <tr>
                                                <td class="font-weight-bold">Phone</td>
                                                <td>{{$cr->user->phone.' / '.$cr->user->phone2 }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="font-weight-bold">Birthday</td>
                                            <td>{{$cr->user->dob }}</td>
                                        </tr>
                                    

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    {{--Child Profile Ends--}}

@endsection
