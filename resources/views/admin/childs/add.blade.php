@extends('layouts.master')
@section('page_title', 'Create Childs')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title">Add new childs</h6>
                    <a href="{{ route('my_children') }}" class="btn btn-info float-right">View Your Child</a>


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
                                        <input value="{{ old('name') }}"  type="text" name="name" placeholder="Full Name" class="form-control">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address: <span class="text-danger">*</span></label>
                                        <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" >
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email address: </label>
                                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Email Address">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">Gender: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="gender" name="gender"  data-fouc data-placeholder="Choose..">
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
                                        @error('my_parent_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Upload Your Child Photo:</label>
                                        <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc onchange="previewImage(event)">
                                        <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                        @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                           
                                        <img id="showImage" src="{{ (!empty($ut->photo)) ? asset('storage/uploads/'.$ut->photo) : asset('storage/uploads/default-photo.png') }}" alt="" srcset="" width="100" height="auto">
                                       
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
