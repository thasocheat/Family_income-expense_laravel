@extends('layouts.master')
@section('page_title', 'User Account')

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
                    {{-- <ul class="nav nav-tabs nav-tabs-highlight">

                        @if(Qs::userIsAP())
                            <li class="nav-item"><a href="#edit-profile" class="nav-link active" data-toggle="tab">Manage Profile</a></li>
                        @endif

                    </ul> --}}

                    <div class="tab-content">
                        {{-- @if(Qs::userIsAP()) --}}

                            {{-- <div class="tab-pane fade show active" id="edit-profile"> --}}
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
                                                        @error('username')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>

                                            @else

                                                <div class="form-group row">
                                                    <label for="username" class="col-lg-3 col-form-label font-weight-semibold">Username </label>
                                                    <div class="col-lg-9">
                                                        <input id="username" name="username"  type="text" class="form-control" >
                                                        @error('username')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group row">
                                                <label for="gender" class="col-lg-3 col-form-label font-weight-semibold">Gender: <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <select class="select form-control" id="gender" name="gender" data-fouc data-placeholder="Choose..">
                                                        <option value=""></option>
                                                        <option {{ $pro_edit->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                                        <option {{ $pro_edit->gender  == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-lg-3 col-form-label font-weight-semibold">Email </label>
                                                <div class="col-lg-9">
                                                    <input id="email" value="{{ $pro_edit->email }}" name="email"  type="email" class="form-control" >
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                    <input  accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc onchange="previewImage(event)">
                                                </div>
                                                <div class="form-group">

                                                    <img id="showImage" src="{{ (!empty($pro_edit->photo)) ? Auth::user()->photo : url('storage/uploads/default-photo.png') }}" alt="" srcset="" width="100" height="auto">

                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        {{-- @endif --}}


                            {{-- <div class="tab-pane fade" id="change-pass"> --}}

                                {{-- <div class="row">
                                    <div class="col-md-8 m-3">
                                        <form method="post" action="{{ route('account_user.change_pass') }}">
                                            @csrf @method('put')

                                            <div class="form-group row">
                                                <label for="current_password" class="col-lg-3 col-form-label font-weight-semibold">Current Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="current_password" name="current_password"  type="password" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-lg-3 col-form-label font-weight-semibold">New Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="password" name="password"  type="password" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password_confirmation" class="col-lg-3 col-form-label font-weight-semibold">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="password_confirmation" name="password_confirmation"  type="password" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}
                            {{-- </div> --}}
                    </div>
                </div>
            </div>

            @if(Qs::userIsAP())

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Change Password</h6>
                    {!! Qs::getPanelOptions() !!}
                </div>

                <div class="card-body">


                    <div class="tab-content">



                            {{-- <div class="tab-pane fade" id="change-pass"> --}}
                                <div class="row">
                                    <div class="col-md-8 m-3">
                                        <form method="post" action="{{ route('account_user.change_pass') }}">
                                            @csrf @method('put')

                                            <div class="form-group row">
                                                <label for="current_password" class="col-lg-3 col-form-label font-weight-semibold">Current Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="current_password" name="current_password"  type="password" class="form-control" >
                                                     @error('current_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-lg-3 col-form-label font-weight-semibold">New Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="password" name="password"  type="password" class="form-control" >
                                                     @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password_confirmation" class="col-lg-3 col-form-label font-weight-semibold">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input id="password_confirmation" name="password_confirmation"  type="password" class="form-control" >
                                                     @error('password_confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            {{-- </div> --}}
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>

<script type="text/javascript">
    // $(document).ready(function(){
    //     $('#photo').change(function(){
    //         var reader = new FileReader();
    //         reader.onload = function(e){
    //             $('#showImage').attr('src',e.target.result);
    //         }
    //         reader.readAsDataURL(e.target.files['0']);
    //     });
    // });
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function(){
            var dataURL = reader.result;
            var image = document.getElementById('showImage');
            image.src = dataURL;
        };

        reader.readAsDataURL(input.files[0]);
    }
    </script>


@endsection
