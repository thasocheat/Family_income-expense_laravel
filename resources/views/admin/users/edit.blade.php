@extends('layouts.master')
@section('page_title', 'Create User')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Edit user</h6>
                    <a href="{{ route('users.index') }}" class="btn btn-info float-right">Back</a>


                </div>

                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-update" action="{{ route('users.update', Qs::hash($user->id)) }}" data-fouc>
                        @csrf @method('PUT')
                        <h6>Personal Data</h6>

                        <fieldset>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="user_type"> Select User: <span class="text-danger">*</span></label>
                                        <select disabled="disabled" class="form-control select" id="user_type">
                                            <option value="">{{ strtoupper($user->user_type) }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Full Name: <span class="text-danger">*</span></label>
                                        <input value="{{ $user->name }}"  type="text" name="name" placeholder="Full Name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>UserName: <span class="text-danger">*</span></label>
                                        <input value="{{ $user->username }}"  type="text" name="username" placeholder="User Name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address: <span class="text-danger">*</span></label>
                                        <input value="{{ $user->address }}" class="form-control" placeholder="Address" name="address" type="text" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <div class="input-group date" id="date_of_birth" data-target-input="nearest">
                                            <input type="text" value="{{ \Carbon\Carbon::parse($user->dob)->format('m/d/Y') }}" name="dob" class="form-control datetimepicker-input" data-target="#date_of_birth" placeholder="">
                                            <div class="input-group-append" data-target="#date_of_birth" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email address: </label>
                                        <input value="{{ $user->email }}" type="email" name="email" class="form-control" placeholder="your@email.com">

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone:</label>
                                        <input value="{{ $user->phone }}" type="text" name="phone" class="form-control" placeholder="" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telephone:</label>
                                        <input value="{{ $user->phone2 }}" type="text" name="phone2" class="form-control" placeholder="" >
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                @if(in_array($user->user_type, Qs::getStaff()))
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date of Birth:</label>
                                            <input autocomplete="off" name="created_at" value="{{ $user->first()->created_at }}" type="text" class="form-control date-pick" placeholder="Select Date...">

                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">Gender: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="gender" name="gender"  data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option {{ ($user->gender == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ ($user->gender == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Passport
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Upload Passport Photo:</label>
                                        <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                        <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                {{--PASSPORT--}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Upload Photo:</label>
                                        <input value="{{ old('photo') }}" accept="image/*" type="file" id="photo" name="photo" class="form-input-styled" data-fouc onchange="previewImage(event)">
                                        <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                        @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        @if (!empty($user->photo))
                                            @php
                                                $imageUrl = asset('storage/uploads/' . $userType . '/' . basename($imageName));
                                                $relativeUrl = str_replace(url('/'), '', $imageUrl);
                                            @endphp
                                            <img id="showImage" src="{{ $relativeUrl }}" width="100" height="auto" alt="User Photo">
                                        @else

                                            <img id="showImage" src="{{ asset('storage/uploads/default-photo.png') }}" width="100" height="auto" alt="Default Photo">

                                        @endif
                                        {{-- {{ (!empty($user->photo)) ? asset('storage/uploads/' . $userType . '/' . basename($imageName)) : asset('storage/uploads/default-photo.png') }} --}}
                                    </div>
                                </div>
                            </div>

                        </fieldset>



                        <button type="submit" class="btn btn-primary">Update</button>


                    </form>
                </div>

            </div>
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
