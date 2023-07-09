@extends('layouts.master')
@section('page_title', 'Create Income Category')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Manage Category Income</h6>
                    <a href="{{route('in_category.index')}}" class="btn btn-info float-right">View Your Category</a>

                </div>


                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="nav-item"><a href="#new-user" class="nav-link active" data-toggle="tab">Create New Category</a></li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="new-user">
                            <form method="post" class="wizard-form steps-validation ajax-store" action="{{ route('in_category.store') }}" data-fouc>
                                @csrf

                                <fieldset>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category Name: <span class="text-danger">*</span></label>
                                                <input value="{{ old('name') }}"  type="text" name="name" placeholder="Category Name" class="form-control">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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

</div>

    {{--Student List Ends--}}

@endsection
