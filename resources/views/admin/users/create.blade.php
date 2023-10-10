@extends('layouts.master')
@section('page_title', 'Manage Users')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Manage Users</h6>
                    <a href="{{ route('users.index') }}" class="btn btn-info float-right">View Users</a>

                </div>


                <div class="card-body">


                    <div class="tab-content">
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"   data-fouc>
                            @csrf

                            <fieldset>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="user_type"> Select User: <span class="text-danger">*</span></label>
                                            <select  data-placeholder="Select User" class="form-control select" name="user_type" id="user_type">
                                                @foreach($user_types as $ut)
                                                    <option value="{{ Qs::hash($ut->id) }}">{{ $ut->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name: <span class="text-danger">*</span></label>
                                            <input value="{{ old('name') }}" type="text" name="name" placeholder="Full Name" class="form-control">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="gender">Gender: <span class="text-danger">*</span></label>
                                            <select class="select form-control" id="gender" name="gender"  data-fouc data-placeholder="Choose..">
                                                <option value=""></option>
                                                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                                <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                            </select>
                                             @error('gender')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Date of Birth:</label>
                                            <div class="input-group date" id="date_of_birth" data-target-input="nearest">
                                                <input type="text" value="{{ old('dob') }}" name="dob" class="form-control datetimepicker-input" data-target="#date_of_birth" placeholder="Select Date...">
                                                <div class="input-group-append" data-target="#date_of_birth" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Date of Em:</label>
                                            <div class="input-group date" id="date_of_em" data-target-input="nearest">
                                                <input type="text" name="emp_date" value="{{ old('emp_date') }}" class="form-control datetimepicker-input" data-target="#date_of_em" placeholder="Select Date...">
                                                <div class="input-group-append" data-target="#date_of_em" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            {{-- <input autocomplete="off" name="emp_date" value="{{ old('emp_date') }}" type="text" class="form-control date-pick" placeholder="Select Date..."> --}}
                                             {{-- @error('emp_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror --}}

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email address: <span class="text-danger">*</span></label>
                                            <input value="{{ old('email') }}" type="email" name="email" class="form-control" placeholder="your@email.com">
                                             @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Username: <span class="text-danger">*</span></label>
                                            <input value="{{ old('username') }}" type="text" name="username" class="form-control" placeholder="Username">
                                             @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Password: <span class="text-danger">*</span></label>
                                            <input id="password" type="password" name="password" class="form-control"  >
                                             @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address: <span class="text-danger">*</span></label>
                                            <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" >
                                             @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone:</label>
                                            <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="+2341234567" >
                                             @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Telephone:</label>
                                            <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="+2341234567" >
                                             @error('phone2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>  
                                </div>



                                <div class="row">
                                    {{--PASSPORT--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="d-block">Upload User Photo:</label>
                                            <input value="{{ old('photo') }}" accept="image/*" type="file" id="photo" name="photo" class="form-input-styled" data-fouc onchange="previewImage(event)">
                                            <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                            @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">

                                            @if(!empty($ut->photo) && file_exists(public_path($ut->photo)))

                                                <img id="showImage" src="{{  asset('storage/uploads/'.$ut->photo) }}" alt="" srcset="" width="100" height="auto">
                                                
                                            @else
                                                <img id="showImage" src="{{ asset('storage/uploads/default-photo.png') }}" alt="" srcset="" width="100" height="auto">

                                            @endif
                                           
                                            {{-- <img id="showImage" src="{{ (!empty($ut->photo)) ? asset('storage/uploads/'.$ut->photo) : asset('storage/uploads/default-photo.png') }}" alt="" srcset="" width="100" height="auto"> --}}
                                           
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>

                            </fieldset>




                        </form>



                    </div>
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

    {{--Student List Ends--}}

@endsection
