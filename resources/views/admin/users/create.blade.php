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


                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="new-user">
                            <form method="post" enctype="multipart/form-data"  action="{{ route('users.store') }}" data-fouc>
                                @csrf @method('PUT')

                                <h6>Personal Data</h6>
                                {{-- <fieldset> --}}
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="user_type"> Select User: <span class="text-danger">*</span></label>
                                                <select required data-placeholder="Select User" class="form-control select" name="user_type" id="user_type">
                                        @foreach($user_types as $ut)
                                            <option value="{{ Qs::hash($ut->id) }}">{{ $ut->name }}</option>
                                        @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Full Name: <span class="text-danger">*</span></label>
                                                <input value="{{ old('name') }}" required type="text" name="name" placeholder="Full Name" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address: <span class="text-danger">*</span></label>
                                                <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email address: </label>
                                                <input value="{{ old('email') }}" type="email" name="email" class="form-control" placeholder="your@email.com">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username: </label>
                                                <input value="{{ old('username') }}" type="text" name="username" class="form-control" placeholder="Username">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Phone:</label>
                                                <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="+2341234567" >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Telephone:</label>
                                                <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="+2341234567" >
                                            </div>
                                        </div>

                                    </div>




                                    <div class="row">
                                        {{--PASSPORT--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="d-block">Upload Photo:</label>
                                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                                <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT"> --}}
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                {{-- </fieldset> --}}




                            </form>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

    {{--Student List Ends--}}

@endsection
