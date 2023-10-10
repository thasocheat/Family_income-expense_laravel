@extends('layouts.master')
@section('page_title', 'Manage Members')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Update Members</h6>
                    <a href="{{ route('members.index') }}" class="btn btn-info float-right">View Members</a>

                </div>


                <div class="card-body">


                    <div class="tab-content">
                        <form action=" {{ route('members.update',$members->id) }}" method="post" enctype="multipart/form-data"   data-fouc>
                            @csrf
                            @method('PUT')

                            <fieldset>

                                <div class="row">
                                    <input type="hidden" class="form-control" name="id" value='{{ $members->id }}'>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name: <span class="text-danger">*</span></label>
                                            <input value="{{ $members->name }}" type="text" name="name" placeholder="Full Name" class="form-control">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description: <span class="text-danger">*</span></label>
                                            <input value="{{ $members->description }}  " class="form-control" placeholder="Description" name="description" type="text" >
                                             @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Facebook: <span class="text-danger">*</span></label>
                                            <input value="{{ $members->facebook }}" type="text" name="facebook" placeholder="Facebook url" class="form-control">
                                            @error('facebook')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Telegram: <span class="text-danger">*</span></label>
                                            <input value="{{ $members->instagram }}" type="text" name="instagram" placeholder="Telegram url" class="form-control">
                                            @error('instagram')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Github: <span class="text-danger">*</span></label>
                                            <input value="{{ $members->github }}" type="text" name="github" placeholder="Github url" class="form-control">
                                            @error('github')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{--Profile--}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="d-block">Upload Member Photo:</label>
                                            <input value=" " acc ept="image/*" type="file" id="photo" name="photo" class="form-input-styled" data-fouc onchange="previewImage(event)">
                                            <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                            @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @if (!empty($members->photo))
                                            @php
                                                $imageUrl = asset('storage/uploads/members/' . basename($members->photo));
                                                $relativeUrl = str_replace(url('/'), '', $imageUrl);
                                            @endphp
                                            <img id="showImage" src="{{ $relativeUrl }}" width="100" height="auto" alt="User Photo">
                                            @else

                                                <img id="showImage" src="{{ asset('storage/uploads/profile.png') }}" width="100" height="auto" alt="Default Photo">

                                            @endif

                                        </div>
                                        {{-- <div class="form-group">

                                            <img id="showImage" src="{{ (!empty($ut->photo)) ? asset('storage/uploads/'.$ut->photo) : asset('storage/uploads/default-photo.png') }}" alt="" srcset="" width="100" height="auto">

                                        </div> --}}
                                    </div>

                                </div>


                                <button type="submit" class="btn btn-info">Update</button>

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
