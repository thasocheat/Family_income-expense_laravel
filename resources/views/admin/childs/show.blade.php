@extends('layouts.master')
@section('page_title', 'Show Child - '.$user->name)
@section('content')
<div class="row">
    <div class="col-md-3 text-center">
        <div class="card">
            <div class="card-body">
                <img style="width: 90%; height:90%" src="{{ $user->photo }}" alt="photo" class="rounded-circle">
                <br>
                <h3 class="mt-3">{{ $user->name }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">{{ $user->name }}</a>
                    </li>
                </ul>

                <div class="tab-content">
                    {{--Basic Info--}}
                    <div class="tab-pane fade show active" id="basic-info">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="font-weight-bold">Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">ADM_NO</td>
                                <td>{{ $adm_no }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Class</td>
                                <td>{{ $my_class->name.' '.$section->name }}</td>
                            </tr>
                            @if($my_parent_id)
                                <tr>
                                    <td class="font-weight-bold">Parent</td>
                                    <td>
                                        <span><a target="_blank" href="{{ route('users.show', Qs::hash($my_parent_id)) }}">{{ $my_parent->name }}</a></span>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td class="font-weight-bold">Year Admitted</td>
                                <td>{{ $year_admitted }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Gender</td>
                                <td>{{ $user->gender }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Address</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                            @if($user->email)
                            <tr>
                                <td class="font-weight-bold">Email</td>
                                <td>{{$user->email }}</td>
                            </tr>
                            @endif
                            @if($user->phone)
                                <tr>
                                    <td class="font-weight-bold">Phone</td>
                                    <td>{{$user->phone.' '.$user->phone2 }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="font-weight-bold">Birthday</td>
                                <td>{{$user->dob }}</td>
                            </tr>
                            @if($user->bg_id)
                            <tr>
                                <td class="font-weight-bold">Blood Group</td>
                                <td>{{$user->blood_group->name }}</td>
                            </tr>
                            @endif
                            @if($user->nal_id)
                            <tr>
                                <td class="font-weight-bold">Nationality</td>
                                <td>{{$user->nationality->name }}</td>
                            </tr>
                            @endif
                            @if($user->state_id)
                            <tr>
                                <td class="font-weight-bold">State</td>
                                <td>{{$user->state->name }}</td>
                            </tr>
                            @endif
                            @if($user->lga_id)
                            <tr>
                                <td class="font-weight-bold">LGA</td>
                                <td>{{$user->lga->name }}</td>
                            </tr>
                            @endif
                            @if($dorm_id)
                                <tr>
                                    <td class="font-weight-bold">Dormitory</td>
                                    <td>{{$dorm->name.' '.$dorm_room_no }}</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


    {{--Student Profile Ends--}}

@endsection
