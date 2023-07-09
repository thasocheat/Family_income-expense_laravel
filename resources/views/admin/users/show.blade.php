@extends('layouts.master')
@section('page_title', 'User Profile - '.$user->name)
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-body">
                            @if (!empty($user->photo))
                            @php
                                $imageUrl = asset('storage/uploads/' . $userType . '/' . basename($imageName));
                                $relativeUrl = str_replace(url('/'), '', $imageUrl);
                            @endphp
                            <img id="showImage" src="{{ $relativeUrl }}" width="100" height="auto" alt="User Photo">
                            @else

                                <img id="showImage" src="{{ asset('storage/uploads/default-photo.png') }}" width="100" height="auto" alt="Default Photo">

                            @endif
                            {{-- <img style="width: 90%; height:90%" src="{{ $user->photo }}" alt="photo" class="rounded-circle"> --}}
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
                                    <a href="#" class="nav-link active" >{{ $user->name }}</a>
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
                                        @if($user->username)
                                            <tr>
                                                <td class="font-weight-bold">Username</td>
                                                <td>{{$user->username }}</td>
                                            </tr>
                                        @endif
                                        @if($user->phone)
                                            <tr>
                                                <td class="font-weight-bold">Phone</td>
                                                <td>{{$user->phone.' / '.$user->phone2 }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="font-weight-bold">Birthday</td>
                                            <td>{{ \Carbon\Carbon::parse($user->dob)->format('m/d/Y') }}</td>
                                        </tr>

                                        @if($user->user_type == 'parent')
                                            <tr>
                                                <td class="font-weight-bold">Children/Ward</td>
                                                <td>
                                                @foreach(Qs::findMyChildren($user->id) as $cr)
                                                    <span> - <a href="{{ route('childs.show', Qs::hash($cr->id)) }}">{{ $cr->user->name }}</a></span><br>

                                                    @endforeach
                                                </td>
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


    {{--User Profile Ends--}}
     </div>
    </div>

</div>
@endsection
