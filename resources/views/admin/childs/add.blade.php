@extends('layouts.master')
@section('page_title', 'Create Childs')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title">Add new childs</h6>

                    {!! Qs::getPanelOptions() !!}
                </div>

                <div class="card-body">
                    <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ route('childs.store') }}" data-fouc>
                        @csrf
                        @method('put')
                        <h6>Personal data</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
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
                                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">Gender: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone:</label>
                                        <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telephone:</label>
                                        <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="" >
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <input name="dob" value="{{ old('dob') }}" type="text" class="form-control date-pick" placeholder="Select Date...">

                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="my_parent_id">Parent: </label>
                                        <select data-placeholder="Choose..."  name="my_parent_id" id="my_parent_id" class="select-search form-control">
                                            <option  value=""></option>
                                            @foreach($parents as $p)
                                                <option {{ (old('my_parent_id') == Qs::hash($p->id)) ? 'selected' : '' }} value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Upload Passport Photo:</label>
                                        <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                        <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                    </div>
                                </div>
                            </div>

                        </fieldset>

<input type="submit" value="Save">
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
    @endsection
