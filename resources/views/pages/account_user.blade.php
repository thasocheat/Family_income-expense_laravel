@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">My Account</h6>
                    {!! Qs::getPanelOptions() !!}
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight">

                        @if(Qs::userIsAP())
                            <li class="nav-item"><a href="#edit-profile" class="nav-link active" data-toggle="tab">Manage Profile</a></li>
                        @endif
                            <li class="nav-item"><a href="#change-pass" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>Change Password</a></li>

                    </ul>

                    <div class="tab-content">
                        @if(Qs::userIsAP())

                            <div class="tab-pane fade show active" id="edit-profile">
                                <div class="row">
                                    <div class="col-md-6  m-3">
                                        <form enctype="multipart/form-data" method="post" action="{{ route('account_user.update') }}">
                                            @csrf @method('put')

                                            <div class="form-group row">
                                                <label for="name" class="col-lg-3 col-form-label font-weight-semibold">Name</label>
                                                <div class="col-lg-9">
                                                    <input  id="name" class="form-control" type="text" value="{{ $pro_edit->name }}">
                                                </div>
                                            </div>

                                            @if($pro_edit->username)
                                                <div class="form-group row">
                                                    <label for="username" class="col-lg-3 col-form-label font-weight-semibold">Username</label>
                                                    <div class="col-lg-9">
                                                        <input id="username" class="form-control" type="text" value="{{ $pro_edit->username }}">
                                                    </div>
                                                </div>

                                            @else

                                                <div class="form-group row">
                                                    <label for="username" class="col-lg-3 col-form-label font-weight-semibold">Username </label>
                                                    <div class="col-lg-9">
                                                        <input id="username" name="username"  type="text" class="form-control" >
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group row">
                                                <label for="email" class="col-lg-3 col-form-label font-weight-semibold">Email </label>
                                                <div class="col-lg-9">
                                                    <input id="email" value="{{ $pro_edit->email }}" name="email"  type="email" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-lg-3 col-form-label font-weight-semibold">Phone </label>
                                                <div class="col-lg-9">
                                                    <input id="phone" value="{{ $pro_edit->phone }}" name="phone"  type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone2" class="col-lg-3 col-form-label font-weight-semibold">Telephone </label>
                                                <div class="col-lg-9">
                                                    <input id="phone2" value="{{ $pro_edit->phone2 }}" name="phone2"  type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="address" class="col-lg-3 col-form-label font-weight-semibold">Address </label>
                                                <div class="col-lg-9">
                                                    <input id="address" value="{{ $pro_edit->address }}" name="address"  type="text"  class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="address" class="col-lg-3 col-form-label font-weight-semibold">Change Photo </label>
                                                <div class="col-lg-9">
                                                    <input  accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                            <div class="tab-pane fade" id="change-pass">

                                <div class="row">
                                    <div class="col-md-8 m-3">
                                        <form method="post" action="{{ route('account_user.change_pass') }}">
                                            @csrf @method('put')

                                            <div class="form-group row">
                                                <label for="current_password" class="col-lg-3 col-form-label font-weight-semibold">Current Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="current_password" name="current_password"  required type="password" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-lg-3 col-form-label font-weight-semibold">New Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="password" name="password"  required type="password" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password_confirmation" class="col-lg-3 col-form-label font-weight-semibold">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="password_confirmation" name="password_confirmation"  required type="password" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>




@endsection
