@extends('layouts.master')
@section('page_title', 'Edit Childs')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 id="ajax-title" class="card-title">Please fill The form Below To Edit record of {{ $cr->user->name }}</h6>

                    {!! Qs::getPanelOptions() !!}
                </div>

                <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-update" data-reload="#ajax-title" action="{{ route('childs.update', Qs::hash($cr->id)) }}" data-fouc>
                    @csrf @method('PUT')
                    <h6>Personal data</h6>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name: <span class="text-danger">*</span></label>
                                    <input value="{{ $cr->user->name }}" required type="text" name="name" placeholder="Full Name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address: <span class="text-danger">*</span></label>
                                    <input value="{{ $cr->user->address }}" class="form-control" placeholder="Address" name="address" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email address: <span class="text-danger">*</span></label>
                                    <input value="{{ $cr->user->email  }}" type="email" name="email" class="form-control" placeholder="your@email.com">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">Gender: <span class="text-danger">*</span></label>
                                    <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
                                        <option value=""></option>
                                        <option {{ ($cr->user->gender  == 'Male' ? 'selected' : '') }} value="Male">Male</option>
                                        <option {{ ($cr->user->gender  == 'Female' ? 'selected' : '') }} value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Phone:</label>
                                    <input value="{{ $cr->user->phone  }}" type="text" name="phone" class="form-control" placeholder="" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telephone:</label>
                                    <input value="{{ $cr->user->phone2  }}" type="text" name="phone2" class="form-control" placeholder="" >
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date of Birth:</label>
                                    <input name="dob" value="{{ $cr->user->dob  }}" type="text" class="form-control date-pick" placeholder="Select Date...">

                                </div>
                            </div>

                           

                        </div>
                       

                    </fieldset>

                    <h6>Childs Data</h6>
                    <fieldset>
                        <div class="row">
                           

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="my_parent_id">Parent: </label>
                                    <select data-placeholder="Choose..."  name="my_parent_id" id="my_parent_id" class="select-search form-control">
                                        <option  value=""></option>
                                        @foreach($parents as $p)
                                            <option {{ (Qs::hash($cr->parent_id) == Qs::hash($p->id)) ? 'selected' : '' }} value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                           
                        </div>

                      
                    </fieldset>
                    <button type="submit" class="btn btn-info">Submit</button>


                </form>
            </div>
         </div>
    </div>

</div>
@endsection
